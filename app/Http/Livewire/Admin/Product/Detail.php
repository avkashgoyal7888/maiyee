<?php

namespace App\Http\Livewire\Admin\Product;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ProductDetail;

class Detail extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $pro_id,$category_id, $subcategory_id, $subcategories, $category,$product_id,$ideal,$length_type,$brand_color,$ocassion,$pattern,$type,$fabric,$neck,$sleeve,$color,$sale_package,$fabric_care,$style_code;
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

    public function viewProduct()
    {
        if (!empty($this->product)) {
            $this->product = Product::where('sub_id', $this->subcategory_id)->get();
        }
    }




    public function resetinputfields()
    {
        $this->product_id = '';
        $this->category_id = '';
        $this->subcategory_id = '';
        $this->ideal = '';
        $this->length_type = '';
        $this->brand_color = '';
        $this->ocassion = '';
        $this->pattern = '';
        $this->type = '';
        $this->fabric = '';
        $this->neck = '';
        $this->sleeve = '';
        $this->color = '';
        $this->sale_package = '';
        $this->fabric_care = '';
        $this->style_code = '';
        $this->pro_id = '';
    }

    protected $rules = [
        'product_id' => 'required',
        'ideal' => 'required',
        'length_type' => 'required',
        'brand_color' => 'required',
        'ocassion' => 'required',
        'pattern' => 'required',
        'type' => 'required',
        'fabric' => 'required',
        'neck' => 'required',
        'sleeve' => 'required',
        'color' => 'required',
        'sale_package' => 'required',
        'fabric_care' => 'required',
        'style_code' => 'required',
    ];

    protected $messages = [
        'product_id.required' => 'Product Name is required',
        'ideal.required' => 'Ideal is required',
        'length_type.required' => 'Length Type is required',
        'brand_color.required' => 'Brand Color is required',
        'ocassion.required' => 'Ocassion is required',
        'pattern.required' => 'Pattern is required',
        'type.required' => 'Type is required',
        'fabric.required' => 'Fabric is required',
        'neck.required' => 'Neck Detail is required',
        'sleeve.required' => 'Sleeve is required',
        'color.required' => 'Color is required',
        'sale_package.required' => 'Sale is required',
        'fabric_care.required' => 'Fabric is required',
        'style_code.required' => 'Style Code is required',
    ];

    public function store()
    {
            $validatedata = $this->validate();

            $product = new ProductDetail;
            $product->product_id = $this->product_id;
            $product->ideal = $this->ideal;
            $product->length_type = $this->length_type;
            $product->brand_color = $this->brand_color;
            $product->ocassion = $this->ocassion;
            $product->pattern = $this->pattern;
            $product->type = $this->type;
            $product->fabric = $this->fabric;
            $product->neck = $this->neck;
            $product->sleeve = $this->sleeve;
            $product->color = $this->color;
            $product->sale_package = $this->sale_package;
            $product->fabric_care = $this->fabric_care;
            $product->style_code = $this->style_code;
            $product->save();

            $this->resetinputfields();
            session()->flash('success', 'Congratulations !! Product Added Successfully...');
            $this->emit('closemodal');
    }

    public function viewDetailProduct($id)
    {
        $product = ProductDetail::find($id);
        if ($product) {
            $this->pro_id = $product->id;
            $this->product_id = $product->product_id;
            $this->ideal = $product->ideal;
            $this->length_type = $product->length_type;
            $this->brand_color = $product->brand_color;
            $this->ocassion = $product->ocassion;
            $this->pattern = $product->pattern;
            $this->type = $product->type;
            $this->fabric = $product->fabric;
            $this->neck = $product->neck;
            $this->sleeve = $product->sleeve;
            $this->color = $product->color;
            $this->sale_package = $product->sale_package;
            $this->fabric_care = $product->fabric_care;
            $this->style_code = $product->style_code;

        } else {
            return redirect()->to('/admin/product-detail');
        }

    }

    public function editProduct($id)
    {
        $product = ProductDetail::find($id);
        if ($product) {
            $this->pro_id = $product->id;
            $this->product_id = $product->product_id;
            $this->ideal = $product->ideal;
            $this->length_type = $product->length_type;
            $this->brand_color = $product->brand_color;
            $this->ocassion = $product->ocassion;
            $this->pattern = $product->pattern;
            $this->type = $product->type;
            $this->fabric = $product->fabric;
            $this->neck = $product->neck;
            $this->sleeve = $product->sleeve;
            $this->color = $product->color;
            $this->sale_package = $product->sale_package;
            $this->fabric_care = $product->fabric_care;
            $this->style_code = $product->style_code;

        } else {
            return redirect()->to('/admin/product-detail');
        }

    }

    public function updateProduct()
    {
        $validatedata = $this->validate();
        ProductDetail::Where('id', $this->pro_id)->update([
            'ideal' => $this->ideal,
            'length_type' => $this->length_type,
            'brand_color' => $this->brand_color,
            'ocassion' => $this->ocassion,
            'pattern' => $this->pattern,
            'type' => $this->type,
            'fabric' => $this->fabric,
            'neck' => $this->neck,
            'sleeve' => $this->sleeve,
            'color' => $this->color,
            'sale_package' => $this->sale_package,
            'fabric_care' => $this->fabric_care,
            'style_code' => $this->style_code,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'Details Updated Successfully...');
        $this->emit('closemodal');

    }

    public function deleteProduct($id)
    {
        $product = ProductDetail::find($id);
        if ($product) {
            $this->pro_id = $product->id;

        } else {
            return redirect()->to('/admin/product');
        }
    }

    public function delete()
    {
        ProductDetail::Where('id', $this->pro_id)->delete();
        $this->resetinputfields();
        session()->flash('success', 'Detail Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = ProductDetail::where('fabric_care', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.product.detail', compact('data'));
    }
}
