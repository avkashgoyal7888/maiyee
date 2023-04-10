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
    public $fields = [
        ['size' => ''],
    ];

    public function addField()
    {
        $this->fields[] = ['size' => ''];
    }

    public function removeField($index)
    {
        unset($this->size[$index]);
        $this->size = array_values($this->size);
    }

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
        $validatedData = $this->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_id' => 'required',
            'color_id' => 'required',
            'fields.*.size' => 'required',
        ]);
    
        foreach ($validatedData['fields'] as $key => $value) {
            $size = $value['size'];
            $data = [
                'product_id' => $validatedData['product_id'],
                'color_id' => $validatedData['color_id'],
                'size' => $size,
            ];
            Size::create($data);
        }
    
        $this->reset(['category_id', 'subcategory_id', '    product_id', 'color_id', 'fields']);    
        session()->flash('success', 'Congratulations !! Size Added Successfully...');   
        $this->emit('closemodal');
    }


    public function editSize($id)
    {
        $store = Size::find($id);
        if ($store) {
            $this->pro_id = $store->id;
            $this->size = $store->size;
            // $this->image = $store->image;

        } else {
            return redirect()->to('/admin/size');
        }

    }

    public function updateSize()
    {
        $validatedata = $this->validate();
        $data = Size::find($this->pro_id);
        // $image = $data->image;
        // if ($this->image && $this->image !== $data->image) {
        //     $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
        //     $this->image->storeAs('admin/size', $image, 'real_public');
        //     unlink(public_path('admin/size/' . $data->image));
        // }
        Size::where('id', $this->pro_id)->update([
            'size' => $this->size,
            // 'image' => $image,
        ]);
        $this->resetinputfields();
        session()->flash('success', 'Size Updated Successfully...');
        $this->emit('closemodal');
    }



    public function delete($id)
    {
        $size = Size::where('id', $id)->first();
    
        // if ($size->image != null) {
        //     $image_path = public_path('admin/size/' . $size->image);
        //     if (file_exists($image_path)) {
        //         unlink($image_path);
        //     }
        // }
    
        $size->delete();
        session()->flash('success', 'Congratulations !! Size Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = Size::whereHas('product', function($query){
            $query->where('name','like','%'.$this->search.'%');
        })->orderByDesc('id')->paginate(10);
        return view('livewire.admin.size.index', ['data'=>$data]);
    }
}
