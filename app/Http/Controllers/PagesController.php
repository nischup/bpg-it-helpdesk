<?php

namespace App\Http\Controllers;

use App\Models\Auction;
use App\Models\AuctionProduct;
use App\Models\AuctionBidProduct;
use App\Models\Brand;
use App\Models\Catalogue;
use App\Models\Category;
use App\Models\Subscription;
use App\Models\Neighbourhood;
use App\Models\Ticket;
use App\Models\Status;
use App\Models\Priority;
use App\Models\Severity;
use App\Models\Company;
use App\Models\Project;
use App\Models\ProjectModule;
use App\Models\User;
use App\Models\Unit;
use App\Models\MadeIn;
use App\Models\Favorite;
use App\Models\UserProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function home()
    {
        $products = AuctionProduct::with(['catalogue','auction','thumbnail', 'bids' => function ($q) {
            $q->select('id', 'auction_product_id', 'price');
        }])->join('auctions', 'auctions.id', '=', 'auction_products.auction_id')
            ->withCount('bids')
            ->where('auctions.end_time', '>', Carbon::now())
            ->orderBy('id', 'DESC')
            ->take(20)
            ->get()->map(function ($product) {
                $product['lowest_bid'] = $product->bids->min('price');
                return $product;
            });

        $featured_products = AuctionProduct::with(['catalogue','auction','thumbnail', 'bids' => function ($q) {
            $q->select('id', 'auction_product_id', 'price');
        }])->join('auctions', 'auctions.id', '=', 'auction_products.auction_id')
            ->withCount('bids')
            ->where('auctions.end_time', '>', Carbon::now())
            ->where('auctions.featured', 1)
            ->orderBy('id', 'DESC')
            ->take(20)
            ->get()->map(function ($featured_products) {
                $featured_products['lowest_bid'] = $featured_products->bids->min('price');
                return $featured_products;
            });

        $categories = Category::with(['catalogues' => function($query) {
            $query->with('products.auction', function ($qw) {
                $qw->orderBy('id', 'DESC');
            })->whereHas('products')
                ->withCount('products')
                ->with('products.thumbnail');
        }])->withCount(['catalogues as catalogue_with_product_count' => function ($q) {
                $q->whereHas('products');
            }])
            ->where('parent_id', 0)
            ->get();

        return view('frontend.home', [
            'products' => $products,
            'featured_products' => $featured_products,
            'categories' => $categories
        ]);
    }

    public function phoneVerify()
    {
        return view('auth.verify-phone')
            ->with(['phone' => session('phone')]);
    }

    public function dashboard()
    {
        $my_all_ticket = Ticket::where('created_by', auth()->user()->id)->count();
        $my_inprogress_ticket = Ticket::where('status_id', '3')->where('created_by', auth()->user()->id)->count();
        $my_open_ticket = Ticket::where('status_id', '1')->where('created_by', auth()->user()->id)->count();
        $my_close_ticket = Ticket::where('status_id', '2')->where('created_by', auth()->user()->id)->count();

        $recent_tickets = Ticket::select('tickets.id as ticket_id', 'tickets.subject as subject', 'tickets.status_id as status','tickets.severity_id as severity', 'tickets.priority_id as priority', 'tickets.created_at', 'users.id as user_id', 'users.name as username')->join('users', 'users.id', '=', 'tickets.created_by')
            // ->where('auctions.end_time', '>', Carbon::now())
            ->where('tickets.created_by', '=', Auth::user()->id)
            ->orderBy('ticket_id', 'DESC')
            ->take(30)
            ->get()->toArray();          

            $deadline_tickets = Ticket::select('tickets.id as ticket_id', 'tickets.subject as subject', 'tickets.status_id as status','tickets.severity_id as severity', 'tickets.priority_id as priority', 'tickets.deadline as deadline', 'tickets.created_at', 'tickets.assign_to as assign_to', 'users.id as user_id', 'users.name as username')->join('users', 'users.id', '=', 'tickets.created_by')
            ->where('tickets.deadline', '<', Carbon::now())
            ->where('tickets.created_by', '=', Auth::user()->id)
            ->where('tickets.assign_to', '=', Auth::user()->id)
            ->orderBy('tickets.deadline', 'DESC')
            ->take(30)
            ->get()->toArray();        

            $high_priority_tickets = Ticket::select('tickets.id as ticket_id', 'tickets.subject as subject', 'tickets.status_id as status','tickets.priority_id as priority', 'tickets.severity_id as severity','tickets.created_at', 'users.id as user_id', 'users.name as username')->join('users', 'users.id', '=', 'tickets.created_by')
            ->where('tickets.priority_id', '1')
            ->where('tickets.created_by', '=', Auth::user()->id)
            ->orderBy('ticket_id', 'DESC')
            ->take(30)
            ->get()->toArray();


        return view('frontend.dashboard', [
            'my_all_ticket' => $my_all_ticket,
            'my_inprogress_ticket' => $my_inprogress_ticket,
            'my_close_ticket' => $my_close_ticket,
            'my_open_ticket' => $my_open_ticket,
            'recent_tickets' => $recent_tickets,
            'high_priority_tickets' => $high_priority_tickets,
            'deadline_tickets' => $deadline_tickets,
        ]);
    }

    public function assignedTicketToUser($id, Request $request)
    {
        if (!$request->id) {
            abort(404);
        }

        // if (!profileStatusCompleted()) {
        //     session()->flash('error', __('You must complete your profile before creating ticket'));
        //     return redirect()->route('frontend.profile');
        // }

        $ticket = Ticket::with('category', 'company', 'project', 'project_module', 'user', 'status', 'priority', 'severity')->findOrFail($request->id);
        // dd($ticket->status);
        $status = Status::get();
        $priority = Priority::get();
        $severity = Severity::get();
        $category = Category::where('parent_id', '0')->get();
        $companies = Company::get();
        $projects = Project::get();
        $project_modules = ProjectModule::get();
        $companies = Company::get();
        $user = User::where('is_active', '1')->get();

        return view('frontend.ticket-assign-to-user',[
            'ticket' => $ticket,
            'status' => $status,
            'priority' => $priority,
            'severity' => $severity,
            'category' => $category,
            'companies' => $companies,
            'projects' => $projects,
            'project_modules' => $project_modules,
            'user' => $user,
        ]);
    }


    public function profile()
    {
        return view('frontend.profile');
    }

    public function viewProfile()
    {
        $profile = UserProfile::with('company')
            ->select('user_profiles.*', 'countries.id', 'countries.name as country_name', 'cities.id', 'cities.name as city_name')
            ->join('countries', 'countries.id', '=', 'user_profiles.country')
            ->join('cities', 'cities.id', '=', 'user_profiles.city')
            ->where('user_profiles.user_id', auth()->user()->id)
            ->first();
        
        $categories = explode(',',  $profile->parent_category_id);
        // $cat_arr = array();
        // foreach($categories as $key=>$val)
        // {
        //     $vl = preg_replace('#[^\w()/.%\-&]#', "", $val);
        //     $cat_arr[$vl] = $vl;
        // }

        $neighbour = Neighbourhood::where('id', $profile->neighbourhood)->first();
        $cat = Category::whereIn('id', $categories)->get();
        return view('frontend.view-profile', compact('profile', 'cat','neighbour'));
    }

    public function newTicket()
    {
        return view('frontend.new-ticket');
    }    

    public function allTicket()
    {
        $all_tickets = Ticket::select('tickets.id as ticket_id', 'tickets.subject as subject', 'tickets.status_id as status','tickets.severity_id as severity', 'tickets.priority_id as priority', 'tickets.created_at', 'users.id as user_id', 'users.name as username')->join('users', 'users.id', '=', 'tickets.created_by')
            // ->where('auctions.end_time', '>', Carbon::now())
            // ->where('auction_target_suppliers.supplier_id', '=', Auth::user()->id)
            ->orderBy('ticket_id', 'DESC')
            ->get()->toArray(); 

        return view('frontend.all-ticket', ['all_tickets' => $all_tickets]);
    }    

    public function myTicket()
    {
        $my_tickets = Ticket::select('tickets.id as ticket_id', 'tickets.subject as subject', 'tickets.status_id as status','tickets.severity_id as severity', 'tickets.priority_id as priority', 'tickets.created_at', 'users.id as user_id', 'users.name as username')->join('users', 'users.id', '=', 'tickets.created_by')
            ->where('tickets.created_by', '=', Auth::user()->id)
            ->orderBy('ticket_id', 'DESC')
            ->get()->toArray(); 

        return view('frontend.my-ticket', ['my_tickets' => $my_tickets]);
    }    

    public function assignedTicket()
    {
        $assigned_tickets = Ticket::select('tickets.id as ticket_id', 'tickets.subject as subject', 'tickets.status_id as status','tickets.severity_id as severity', 'tickets.priority_id as priority', 'tickets.created_at',  'tickets.assign_to', 'users.id as user_id', 'users.name as username')->join('users', 'users.id', '=', 'tickets.created_by')
            ->where('tickets.assign_to', '=', Auth::user()->id)
            ->orderBy('ticket_id', 'DESC')
            ->get()->toArray(); 

        return view('frontend.assigned-ticket', ['assigned_tickets' => $assigned_tickets]);
    }


    public function newAuction()
    {
        if (!profileStatusCompleted()) {
            session()->flash('error', __('You must complete your profile before creating auctions'));
            return redirect()->route('frontend.profile');
        }

        return view('frontend.new-auction');
    }


    public function assignSubmit(Request $request)
    {
        $request->validate([
            'assign_to' => 'required',
        ]);

        Ticket::where('id', $request->ticket_id)->update(['assign_to' => $request->assign_to, 'assign_by' => auth()->user()->id]);

        $assign_user_name = User::where('id', $request->assign_to)->first()->name;
        // dd($user_data);
        session()->flash('message', __('Your Ticket Assigned to "'.$assign_user_name.'"'));

        return redirect()->back();
    }

    public function contact()
    {
        return view('frontend.contact');
    }


    public function faq()
    {
        return view('frontend.faqs');
    }

    public function myAuctions($status = null)
    {
        $data = [
            'status' => $status ?? 'All',
            'auctions' => $this->getMyAuctions($status)
        ];
        switch ($status) {
            case 'active':
                return view('frontend.my-auctions-active', $data);
            case 'closed':
                return view('frontend.my-auctions-close', $data);
            case 'won':
                return view('frontend.my-auctions-won', $data);
            default:
                return view('frontend.my-auctions', $data);
        }
    }

    private function getMyAuctions($status)
    {
        if ($status == 'active') {
            $auctions = Auction::where('user_id', auth()->user()->id)
                ->where('end_time', '>', Carbon::now())
                ->orderBy('id', 'desc');
        } else if ($status == 'closed') {
            $auctions = Auction::where('user_id', auth()->user()->id)
                ->where('end_time', '<=', Carbon::now())->orderBy('id', 'desc');
        }else if ($status == 'won') {
            $auctions = Auction::where('user_id', auth()->user()->id)->orderBy('id', 'desc');
        } 
        // else if ($status == 'won') {
        //     $auctions = Auction::whereHas('products', function ($q) {
        //         $q->where('winner_id', auth()->user()->id)->orderBy('id', 'desc');
        //     });
        // } 
        else {
            $auctions = Auction::where('user_id', auth()->user()->id)->orderBy('id', 'desc');
        }

        return $auctions->paginate(20);
    }
}
