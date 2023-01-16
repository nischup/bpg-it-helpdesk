<?php

namespace App\Http\Livewire;


use App\Models\BannerAdImage;
use App\Models\Category;
use App\Models\BannerAd;
use App\Models\Project;
use App\Models\Brand;
use App\Models\Company;
use App\Services\ImageService;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class BannerComponent extends Component
{
     use WithPagination,WithFileUploads;

    public $editing = false;
    public $creating = false;
    public $data, $title, $description, $company_id, $city_id;
    public $images = [];
    public $oldImages = [];
    public $category_column;
    public $child_categories;

    public array $selectedRoles = [];
    public $per_page = 10;
    public $query = '';

    protected $paginationTheme = 'bootstrap';



    public function render()
    {
        $nbrh_list = new Project();

        if ($this->query) {
            $nbrh_list = $nbrh_list->where('title','LIKE','%'. $this->query .'%');
        }

        if ($this->company_id) {
            $nbrh_list = $nbrh_list->where('company_id', $this->company_id);
        }

        return view('admin.livewire.banner.index', [
            'list' => $nbrh_list->orderBy('id', 'desc')->paginate($this->per_page)
        ]);

         // return view('admin.livewire.neighbourhood');
    }

    public function cancel()
    {
        $this->resetInput();
    }

    private function resetInput()
    {
        $this->title = null;
        $this->selectedRoles = [];

        $this->dispatchBrowserEvent('clearSelect');
    }

    public function store()
    {
        $this->validate([
            'company_id' => 'required',
            'title' => 'required',
        ]);

        $catalogue = Project::create([
            'company_id' => $this->company_id,
            'name' => $this->title,
        ]);

        dd($catalogue);

        $this->resetForm();
        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Project created successfully!']);
    }

    public function resetForm()
    {
        $this->title = '';
        $this->company_id = '';
        $this->city_id = '';
    }

    public function createNew()
    {
        $this->resetForm();
        $this->creating = true;
    }


    public function edit($id)
    {
        $this->resetForm();
        $this->creating = false;
        $this->editing = $id;

        $catalogue = \App\Models\Project::find($id);
        $this->title = $catalogue->title;
        $this->country_id = $catalogue->country_id;
        $this->city_id = $catalogue->city_id;

        $this->child_categories = City::select('id', $this->category_column, 'name')->where('country_id', $catalogue->parent_category_id)->get()->toArray();
    }

    public function update()
    {
        $this->validate([
            'category' => 'required',
            'title' => 'required',
            'description' => 'nullable'
        ]);

        \App\Models\Project::find($this->editing)->update([
            'title' => $this->title,
            // 'slug' => Str::slug($this->title),
            'country_id' => $this->country_id,
            'city_id' => $this->city_id,
        ]);

        // session()->flash('message', __('Catalogue updated successfully.'));

        // $this->editing = false;
        // $this->showAll();

        $this->dispatchBrowserEvent('closeModal');
        $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Project updated successfully!']);
    }

    public function imageDelete($id, $key)
    {
        $image = CatalogueImage::find($id);

        $path = public_path('storage/' . $image->src_original);
        if (file_exists($path)) {
            unlink($path);
        }

        $image->delete();

        $this->oldImages->forget($key);

        session()->flash('message', __('Image delete successfully.'));
    }

    public function destroy($id)
    {
       
        Neighbourhood::where('id', $id)->update(['status' => 1]);

        // $catalogue->delete();

      $this->dispatchBrowserEvent('alert', ['type' => 'success',  'message' => 'Project Deleted successfully!']);
    }

    public function hydrate()
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }

       public function paginationView()
    {
        return 'admin.pagination';
    }

    public function storeImages($productId, $images)
    {
        $imageService = new ImageService();

        foreach ($images as $image) {
            $list[] = [
                'catalogue_id' => $productId,
                'src' => $imageService->saveImage($image),
            ];
        }


        CatalogueImage::insert($list);
    }

    public function p_categoryChanged($value)
    {
        if (!$value) {
            return;
        }

        $this->child_categories = City::select('id', $this->category_column, 'name')->where('country_id', $value)->get()->toArray();
    }

    public function mount()
    {
        $this->company = Company::select('id','name')->get()->toArray();
    }

}
