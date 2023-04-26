<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $cat_name, $cat_id,$image,$tile;
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

    }

    public function store()
    {
        $validatedata = $this->validate([
            'image' => 'required',
            'tile' => 'required',
        ]);
        if ($this->image != '') {
            $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
            $this->image->storeAs('admin/category', $image, 'real_public');
        }
        if ($this->tile != '') {
            $tile = substr(uniqid(), 0, 9) . '.' . $this->tile->extension();
            $this->tile->storeAs('admin/category', $tile, 'real_public');
        }
        $cat = new Category;
        $cat->cat_name = $this->cat_name;
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

        } else {
            return redirect()->to('/admin/category');
        }
    }

    public function update()
    {
        $validatedata = $this->validate();
        $sub = Category::find($this->cat_id);
    
        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            $ext = $this->image->getClientOriginalExtension();
            $name = substr(uniqid(), 0, 9) . '.' . $ext;
            $image = $name;
            $this->image->storeAs('admin/category', $name, 'real_public');
            $image_path = public_path('admin/category/' . $sub->image);
            unlink($image_path);
        } else {
            $image = $sub->image;
        }
    
        if ($this->tile instanceof \Illuminate\Http\UploadedFile) {
            $ext = $this->tile->getClientOriginalExtension();
            $name = substr(uniqid(), 0, 9) . '.' . $ext;
            $tile = $name;
            $this->tile->storeAs('admin/tile', $name, 'real_public');
            $image_path = public_path('admin/tile/' . $sub->tile);
            unlink($image_path);
        } else {
            $tile = $sub->tile;
        }
    
        $sub->cat_name = $this->cat_name;
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
            $image_path = public_path('admin/category/' . $category->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        if ($category->tile != null) {
            $tile_path = public_path('admin/tile/' . $category->tile);
            if (file_exists($tile_path)) {
                unlink($tile_path);
            }
        }
        $category->delete();
        session()->flash('success', 'Congratulations !! Category Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = Category::where('cat_name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.category.index', ['data'=>$data]);
    }
}
