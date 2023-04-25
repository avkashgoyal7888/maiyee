<?php

namespace App\Http\Livewire\Admin\Subcategory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\SubCategory;
use App\Models\Category;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sub_name, $cat_id, $catid, $sub_id,$image;
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
        'image' => 'required',
    ];
    protected $messages = [
        'cat_id.required' => 'Category is required',
        'sub_name.required' => 'Sub-Category is required.....',
        'image.required' => 'Image is required',
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
        $validatedata = $this->validate();
        if ($this->image != '') {
            $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
            $this->image->storeAs('admin/subcategory', $image, 'real_public');
        }

        $sub_cat = new SubCategory;
        $sub_cat->cat_id = $this->cat_id;
        $sub_cat->sub_name = $this->sub_name;
        $sub_cat->image = $image;
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

        } else {
            return redirect()->to('/admin/sub-category');
        }

    }

    public function update()
    {
        $validatedata = $this->validate();
        $sub = SubCategory::find($this->sub_id);
        if ($this->image != '') {
            $image_path = public_path('admin/category/' . $sub->image);
            unlink($image_path);
    
            $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
            $this->image->storeAs('admin/subcategory', $image, 'real_public');
            $sub->image = $image;
        }
            $sub->cat_id = $this->cat_id;
            $sub->sub_name = $this->sub_name;
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
            $image_path = public_path('admin/subcategory/' . $sub->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $sub->delete();
        session()->flash('success', 'Congratulations !! Category Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = SubCategory::where('sub_name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.subcategory.index', ['data'=>$data]);
    }
}
