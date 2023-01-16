<?php

namespace App\Http\Livewire;

use App\Models\Auction;
use App\Models\Severity;
use App\Models\CatalogueImage;
use App\Models\Category;
use App\Models\Status;
use App\Models\Priority;
use App\Models\User;
use App\Models\Country;
use App\Models\Ticket;
use App\Models\City;
use App\Models\Company;
use App\Models\Project;
use App\Models\ProjectModule;
use App\Models\Catalogue;
use App\Services\AuctionService;
use App\Services\ImageService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class AssignTicketToUser extends Component
{
    use WithFileUploads;

    public $category_column;
    public $projects = [];
    public $project_modules = [];
    public $cities = [];
    public $subject, $brand;
    public $products = [];
    public $catalogues = [];
    public $product, $severity_id, $priority_id, $status_id, $companies, $thumbnail;
    public $comment, $task_category, $company_id;
    public $project, $project_module, $page_name, $issue_details, $remarks;

    public $newTicket = [
        'subject' => '',
        'task_category' => '',
        'company_id' => '',
        'project' => '',
        'project_module' => '',
        'page_name' => '',
        'remarks' => '',
        'issue_details' => '',
        'status_id' => '',
        'priority_id' => '',
        'severity_id' => '',
    ];

    public function resetForm()
    {
        $this->newTicket = [
            'subject' => '',
            'task_category' => '',
            'company_id' => '',
            'project' => '',
            'project_module' => '',
            'page_name' => '',
            'remarks' => '',
            'issue_details' => '',
            'status_id' => '',
            'severity_id' => '',
            'priority_id' => '',
        ];
    }

    public function render()
    {
        return view('frontend.livewire.assign-ticket-to-user');
    }

    public function storeTicket(){
        $this->validate([
            'subject' => 'required',
            'task_category' => 'required',
            'status_id' => 'required',
            'severity_id' => 'required',
            'priority_id' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $auction = Ticket::create([
                'created_by' => auth()->user()->id,
                'subject' => $this->subject,
                'task_category' => $this->task_category,
                'company_id' => $this->company_id,
                'project_id' => $this->project,
                'module_id' => $this->project_module,
                'page_name' => $this->page_name,
                'remarks' => $this->remarks,
                'issue_details' => $this->issue_details,
                'status' => $this->status_id,
                'priority' => $this->priority_id,
                'severity' => $this->severity_id,
            ]);;

            session()->flash('message', __('Ticket Created successfully.'));
            DB::commit();
        } catch (\Exception $e) {
            session()->flash('error', __('Something went wrong! please try again'));
            DB::rollback();
            throw $e;
        } catch (\Throwable $e) {
            session()->flash('error', __('Something went wrong! please try again'));
            DB::rollback();
            throw $e;
        }

        return redirect()->route('frontend.new-ticket');
    }


    public function compnaytoProject($value)
    {
        if (!$value) {
            return;
        }

       $this->projects = Project::select('id', 'name')->where('company_id', $value)->get()->toArray();
    }    

    public function projectToModule($value)
    {
        if (!$value) {
            return;
        }

       $this->project_modules = ProjectModule::select('id', 'title')->where('project_id', $value)->get()->toArray();
    }


    public function mount()
    {
        $this->category_column = 'name_' . app()->getLocale();
        if (!Schema::hasColumn('categories', $this->category_column))
        {
            $this->category_column = 'name_en';
        }

        $this->categories = Category::select('id', $this->category_column, 'name_en')->where('parent_id', 0)->get()->toArray();
        $this->severity = Severity::get();
        $this->status = Status::whereNotIn('id', ['1'])->get();
        $this->priority = Priority::get();
        $this->companies = Company::get();

    }

}
