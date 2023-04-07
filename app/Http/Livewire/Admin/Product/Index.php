<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use Auth;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $pro_id,$category_id, $subcategory_id, $subcategories, $category, $name, $description, $mrp, $hsn_code, $gst_rate, $adminid, $discount, $details;
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
        $category_id = $this->category_id;

    }

    public function updateSubcategories()
    {
        $this->subcategories = SubCategory::where('cat_id', $this->category_id)->get();
    }

    public function viewSubcategories()
    {
        $this->subcategories = SubCategory::where('cat_id', $this->category_id)->get();
        if (!$this->category_id || ($this->subcategories->count() > 0 && !$this->subcategories->contains('id', 
            $this->subcategory_id))) {
            $this->subcategory_id = null;
        }
    }




    public function resetinputfields()
    {
        $this->name = '';
        $this->description = '';
        $this->category_id = '';
        $this->subcategory_id = '';
        $this->mrp = '';
        $this->hsn_code = '';
        $this->gst_rate = '';
        $this->discount = '';
        $this->details = '';
    }

    protected $rules = [
        'name' => 'required',
        'description' => 'required',
        'category_id' => 'required',
        'subcategory_id' => 'required',
        'mrp' => 'required',
        'hsn_code' => 'required',
        'gst_rate' => 'required',
        'discount' => 'required',
        'details' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Product Name is required',
        'description.required' => 'Product Description is required',
        'category_id.required' => 'Category is required',
        'subcategory_id.required' => 'Sub-Category is required',
        'mrp.required' => 'MRP is required',
        'hsn_code.required' => 'HSN is required',
        'gst_rate.required' => 'GST is required',
        'adp.required' => 'ADP is required',
        'details.required' => 'Product Detail is required',
    ];

    public function store()
    {
            $validatedata = $this->validate();

            $product = new Product;
            $product->name = $this->name;
            $product->description = $this->description;
            $product->cat_id = $this->category_id;
            $product->sub_id = $this->subcategory_id;
            $product->mrp = $this->mrp;
            $product->hsn_code = $this->hsn_code;
            $product->gst_rate = $this->gst_rate;
            $product->discount = $this->discount;
            $product->detail = $this->details;

            $product->save();

            $this->resetinputfields();
            session()->flash('success', 'Congratulations !! Product Added Successfully...');
            $this->emit('closemodal');
    }

    public function editProduct($id)
    {
        $product = Product::find($id);
        if ($product) {
            $this->pro_id = $product->id;
            $this->name = $product->name;
            $this->description = $product->description;
            $this->category_id = $product->cat_id;
            $this->subcategory_id = $product->sub_id;
            $this->mrp = $product->mrp;
            $this->hsn_code = $product->hsn_code;
            $this->gst_rate = $product->gst_rate;
            $this->discount = $product->discount;
            $this->details = $product->detail;
            $this->viewSubcategories();

        } else {
            return redirect()->to('/admin/products');
        }

    }

    public function updateProduct()
    {
        $validatedata = $this->validate();
        Product::Where('id', $this->pro_id)->update([
            'name' => $this->name,
            'description' => $this->description,
            'cat_id' => $this->category_id,
            'sub_id' => $this->subcategory_id,
            'mrp' => $this->mrp,
            'hsn_code' => $this->hsn_code,
            'gst_rate' => $this->gst_rate,
            'discount' => $this->discount,
            'detail' => $this->details,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'Product Updated Successfully...');
        $this->emit('closemodal');

    }

    public function delete($id)
    {
        Product::Where('id', $id)->delete();
        session()->flash('success', 'Product Deleted Successfully...');
        $this->emit('closemodal');

    }

    public function render()
    {
        $data = Product::where('name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.product.index', ['data'=>$data]);
    }
}
