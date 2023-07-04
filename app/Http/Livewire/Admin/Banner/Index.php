<?php

namespace App\Http\Livewire\Admin\Banner;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Banner;
use App\Models\Category;
use App\Models\SubCategory;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search, $image, $tag, $banner_id, $category_id, $subcategory_id;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->category = Category::all();
        $this->subcategories = collect();
        $category_id = $this->category_id;

    }

    public function updateSubcategories()
    {
        $this->subcategories = SubCategory::where('cat_id', $this->category_id)->get();
    }

    public function viewSubcategories()
    {
        $this->subcategories = SubCategory::where('cat_id', $this->category_id)->get();
        if (
            !$this->category_id || ($this->subcategories->count() > 0 && !$this->subcategories->contains(
                'id',
                $this->subcategory_id
            )
            )
        ) {
            $this->subcategory_id = null;
        }
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }
    public function resetinputfields()
    {
        $this->image = '';
        $this->tag = '';
        $this->category_id = '';
        $this->subcategory_id = '';
    }

    public function store()
    {
        $validatedata = $this->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'tag' => 'required'
        ], [
                'image.required' => 'Image can not be blank...',
                'tag.required' => 'Remarks can not be blank...',
            ]);

        if ($this->image != '') {
            $imgpath = $this->image->getRealPath();
            $image = Cloudinary::upload($imgpath, [
                'folder' => 'admin/banner',
            ]);
        }
        $banner = new Banner;
        $banner->tag = $this->tag;
        $banner->image = $image->getSecurePath();
        $banner->sub_id = $this->subcategory_id;
        $banner->save();
        $this->resetinputfields();
        session()->flash('success', 'Congratulations !! Banner Added Successfully...');
        $this->emit('closemodal');
    }

    public function deleteBanner($id)
    {
        $banner = Banner::find($id);
        if ($banner) {
            $this->banner_id = $banner->id;

        } else {
            return redirect()->to('/admin/banner');
        }

    }
    public function delete()
    {
        $banner = Banner::where('id', $this->banner_id)->first();

        if ($banner->image != null) {
            $publicId = pathinfo($banner->image)['filename'];
            Cloudinary::destroy("admin/banner/{$publicId}");
        }
        $banner->delete();
        session()->flash('success', 'Congratulations !! Banner Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = Banner::where('image', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.banner.index', compact('data'));
    }
}