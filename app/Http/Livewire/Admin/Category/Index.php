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
    public $cat_name, $cat_id,$image;
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
        'image' => 'required',
    ];
    protected $messages = [
        'cat_name.required' => 'Category is required.....',
        'image.required' => 'Image is required',
    ];

    public function resetinputfields()
    {
        $this->cat_name = '';
        $this->cat_id = '';
        $this->image = '';

    }

    public function store()
    {
        $validatedata = $this->validate();

        if ($this->image != '') {
            $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
            $this->image->storeAs('admin/category', $image, 'real_public');
        }

        $cat = new Category;
        $cat->cat_name = $this->cat_name;
        $cat->image = $image;

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

        } else {
            return redirect()->to('/admin/category');
        }

    }

    public function update()
    {
        $validatedData = $this->validate();
        $cat = Category::find($this->cat_id);
    
        if ($this->image != '') {
            $image_path = public_path('admin/category/' . $cat->image);
            unlink($image_path);
    
            $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
            $this->image->storeAs('admin/category', $image, 'real_public');
            $cat->image = $image;
        }
    
        $cat->cat_name = $this->cat_name;
        $cat->update();
    
        $this->resetInputFields();
        session()->flash('success', 'Category updated successfully.');
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
