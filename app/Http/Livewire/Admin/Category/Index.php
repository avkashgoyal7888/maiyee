<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $cat_name, $cat_id, $image, $tile, $menu;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'cat_name' => 'required',
    ];
    protected $messages = [
        'cat_name.required' => 'Category is required.....',
    ];

    public function resetinputfields()
    {
        $this->cat_name = '';
        $this->cat_id = '';
        $this->image = '';
        $this->tile = '';
        $this->menu = '';
        $this->reset('image', 'tile');

    }

    public function store()
    {
        $validatedata = $this->validate([
            'image' => 'required',
            'tile' => 'required',
            'menu' => 'required',
        ]);

        $image = null;
        $tile = null;

        if ($this->image != null) {
            $imageName = substr(uniqid(), 0, 9);
            $imgpath = $this->image->getRealPath();
            $image = Cloudinary::upload($imgpath, [
                'folder' => 'admin/category',
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
        $cat = new Category;
        $cat->cat_name = $this->cat_name;
        $cat->menu = $this->menu;
        $cat->image = $image;
        $cat->tile = $tile;
        $cat->save();
        $this->resetinputfields();
        session()->flash('success', 'Category Added Successfully...');
        $this->emit('closemodal');
    }


    public function editCategory($id)
    {
        $cat = Category::find($id);
        if ($cat) {
            $this->cat_id = $cat->id;
            $this->cat_name = $cat->cat_name;
            $this->image = $cat->image;
            $this->tile = $cat->tile;
            $this->menu = $cat->menu;

        } else {
            return redirect()->to('/admin/category');
        }
    }

    public function update()
    {
        $validatedata = $this->validate();
        $sub = Category::find($this->cat_id);

        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            if ($sub->image) {
                $publicId = pathinfo($sub->image)['filename'];
                Cloudinary::destroy("admin/category/{$publicId}");
            }
            $imageName = substr(uniqid(), 0, 9);
            $imagepath = $this->image->getRealPath();
            $image = Cloudinary::upload($imagepath, [
                'folder' => 'admin/category',
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
        $sub->cat_name = $this->cat_name;
        $sub->menu = $this->menu;
        $sub->tile = $tile;
        $sub->image = $image;
        $sub->update();
        $this->resetinputfields();
        session()->flash('success', 'Sub-Category Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteCategory($id)
    {
        $cat = Category::find($id);
        if ($cat) {
            $this->cat_id = $cat->id;
        } else {
            return redirect()->to('/admin/category');
        }
    }

    public function delete()
    {
        $category = Category::where('id', $this->cat_id)->first();
        if ($category->image != null) {
            $publicId = pathinfo($category->image)['filename'];
            Cloudinary::destroy("admin/category/{$publicId}");
        }
        if ($category->tile != null) {
            $publicId = pathinfo($category->tile)['filename'];
            Cloudinary::destroy("admin/tile/{$publicId}");
        }
        $category->delete();
        session()->flash('success', 'Congratulations !! Category Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = Category::where('cat_name', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.category.index', ['data' => $data]);
    }
}