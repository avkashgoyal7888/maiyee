<?php

namespace App\Http\Livewire\Admin\Subcategory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\SubCategory;
use App\Models\Category;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sub_name, $cat_id, $catid, $sub_id, $image, $tile;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->category = Category::all();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'cat_id' => 'required',
        'sub_name' => 'required',
    ];
    protected $messages = [
        'cat_id.required' => 'Category is required',
        'sub_name.required' => 'Sub-Category is required.....',
    ];

    public function resetinputfields()
    {
        $this->sub_name = '';
        $this->cat_id = '';
        $this->sub_id = '';
        $this->image = '';
    }

    public function store()
    {
        $validatedata = $this->validate([
            'image' => 'required',
            'tile' => 'required',
        ]);
        if ($this->image != null) {
            $imageName = substr(uniqid(), 0, 9);
            $imgpath = $this->image->getRealPath();
            $image = Cloudinary::upload($imgpath, [
                'folder' => 'admin/subcategory',
                'public_id' => $imageName,
            ])->getSecurePath();
        }
        if ($this->tile != null) {
            $tileName = substr(uniqid(), 0, 9);
            $tilepath = $this->tile->getRealPath();
            $tile = Cloudinary::upload($tilepath, [
                'folder' => 'admin/tile',
                'public_id' => $tileName,
            ])->getSecurePath();
        }
        $sub_cat = new SubCategory;
        $sub_cat->cat_id = $this->cat_id;
        $sub_cat->sub_name = $this->sub_name;
        $sub_cat->image = $image;
        $sub_cat->tile = $tile;
        $sub_cat->save();
        $this->resetinputfields();
        session()->flash('success', 'Sub-Category Added Successfully...');
        $this->emit('closemodal');
    }

    public function editCategory($id)
    {
        $sub_cat = SubCategory::find($id);
        if ($sub_cat) {
            $this->sub_id = $sub_cat->id;
            $this->cat_id = $sub_cat->cat_id;
            $this->sub_name = $sub_cat->sub_name;
            $this->image = $sub_cat->image;
            $this->tile = $sub_cat->tile;
        } else {
            return redirect()->to('/admin/sub-category');
        }
    }

    public function update()
    {
        $validatedata = $this->validate();
        $sub = SubCategory::find($this->sub_id);
        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            if ($sub->image) {
                $publicId = pathinfo($sub->image)['filename'];
                Cloudinary::destroy("admin/subcategory/{$publicId}");
            }
            $imageName = substr(uniqid(), 0, 9);
            $imagepath = $this->image->getRealPath();
            $image = Cloudinary::upload($imagepath, [
                'folder' => 'admin/subcategory',
                'public_id' => $imageName,
            ])->getSecurePath();
        } else {
            $image = $sub->image;
        }
        if ($this->tile instanceof \Illuminate\Http\UploadedFile) {
            if ($sub->tile) {
                $publicId = pathinfo($sub->tile)['filename'];
                Cloudinary::destroy("admin/tile/{$publicId}");
            }
            $tileName = substr(uniqid(), 0, 9);
            $tilepath = $this->tile->getRealPath();
            $tile = Cloudinary::upload($tilepath, [
                'folder' => 'admin/tile',
                'public_id' => $tileName,
            ])->getSecurePath();
        } else {
            $tile = $sub->tile;
        }
        $sub->cat_id = $this->cat_id;
        $sub->sub_name = $this->sub_name;
        $sub->tile = $tile;
        $sub->image = $image;
        $sub->update();
        $this->resetinputfields();
        session()->flash('success', 'Sub-Category Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteSub($id)
    {
        $sub = SubCategory::find($id);
        if ($sub) {
            $this->sub_id = $sub->id;
        } else {
            return redirect()->to('/admin/sub-category');
        }
    }

    public function delete()
    {
        $sub = SubCategory::where('id', $this->sub_id)->first();
        if ($sub->image != null) {
            $publicId = pathinfo($sub->image)['filename'];
            Cloudinary::destroy("admin/subcategory/{$publicId}");
        }
        if ($sub->tile != null) {
            $publicId = pathinfo($sub->tile)['filename'];
            Cloudinary::destroy("admin/tile/{$publicId}");
        }
        $sub->delete();
        session()->flash('success', 'Congratulations !! Category Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = SubCategory::where('sub_name', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.subcategory.index', ['data' => $data]);
    }
}