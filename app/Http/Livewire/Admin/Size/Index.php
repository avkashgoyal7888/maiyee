<?php

namespace App\Http\Livewire\Admin\Size;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Size;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\Color;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $pro_id,$category_id, $subcategory_id, $subcategories, $category, $size, $product_id,$product, $color, $color_id, $image;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    public function mount()
    {
        $this->category = Category::all();
        $this->subcategories = collect();
        $this->product = collect(); // Initialize $this->product
        $this->color = collect(); // Initialize $this->product
        $category_id = $this->category_id;
    }

    public function updateSubcategories()
    {
        $this->subcategories = SubCategory::where('cat_id', $this->category_id)->get();
    }

    public function viewProduct()
    {
        if (!empty($this->product)) {
            $this->product = Product::where('sub_id', $this->subcategory_id)->get();
        }
    }

    public function viewColor()
    {
        if (!empty($this->color)) {
            $this->color = Color::where('product_id', $this->product_id)->get();
        }
    }

    public function resetinputfields()
    {
        $this->category_id = '';
        $this->subcategory_id = '';
        $this->product_id = '';
        $this->color_id = '';
        $this->size = '';
        $this->image = '';
    }

    protected $rules = [
        'size' => 'required',
    ];

    protected $messages = [
        'size.required' => 'Size is required',
    ];

    public function store()
    {   
            $validatedata = $this->validate([   
                'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Add image validation     rules
            ]);

            if ($this->image != '') {
            $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
            $this->image->storeAs('admin/image', $image, 'real_public');
        }

            $size = new Size;
            $size->product_id = $this->product_id;
            $size->color_id = $this->color_id;
            $size->size = $this->size;
            $size->image = $image;

    
            $size->save();
    
            $this->resetinputfields();
            session()->flash('success', 'Congratulations !! Size Added Successfully...');
            $this->emit('closemodal');
    }



    public function editSize($id)
    {
        $store = Size::find($id);
        if ($store) {
            $this->pro_id = $store->id;
            $this->size = $store->size;
            $this->image = $store->image;

        } else {
            return redirect()->to('/admin/size');
        }

    }

    public function updateSize()
    {
        $validatedata = $this->validate();
        $data = Size::find($this->pro_id);
        $image = $data->image;
        if ($this->image && $this->image !== $data->image) {
            $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
            $this->image->storeAs('admin/image', $image, 'real_public');
            unlink(public_path('admin/image/' . $data->image));
        }
        Size::where('id', $this->pro_id)->update([
            'size' => $this->size,
            'image' => $image,
        ]);
        $this->resetinputfields();
        session()->flash('success', 'Size Updated Successfully...');
        $this->emit('closemodal');
    }



    public function delete($id)
    {
        Size::Where('id', $id)->delete();
        session()->flash('success', 'Size Deleted Successfully...');
        $this->emit('closemodal');

    }

    public function render()
    {
        $data = Size::where('size', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.size.index', ['data'=>$data]);
    }
}
