<?php

namespace App\Http\Livewire\Admin\Color;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Color;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $pro_id,$category_id, $subcategory_id, $subcategories, $category, $code, $product_id, $startDate, $endDate,$product;
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

    public function viewProduct()
    {
        if (!empty($this->product)) {
            $this->product = Product::where('sub_id', $this->subcategory_id)->get();
        }
    }


    public function resetinputfields()
    {
        $this->category_id = '';
        $this->subcategory_id = '';
        $this->product_id = '';
        $this->code = '';
    }

    protected $rules = [
        'code' => 'required',
    ];

    protected $messages = [
        'code.required' => 'color Name is required',
    ];

    public function store()
    {
            $validatedata = $this->validate([
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'product_id' => 'required',
                'code' => 'required',
            ],[
                'category_id.required' => 'Select Category first.....',
                'subcategory_id.required' => 'Select Sub-Category first.....',
                'product_id.required' => 'Select Product first.....',
                'code.required' => 'color Name is required',]);
            $clr = new Color;
            $clr->product_id = $this->product_id;
            $clr->code = $this->code;

            $clr->save();

            $this->resetinputfields();
            session()->flash('success', 'Congratulations !! Color Added Successfully...');
            $this->emit('closemodal');
    }

    public function editColor($id)
    {
        $clr = Color::find($id);
        if ($clr) {
            $this->pro_id = $clr->id;
            $this->code = $clr->code;

        } else {
            return redirect()->to('/admin/products');
        }

    }

    public function updateColor()
    {
        $validatedata = $this->validate();
        Color::Where('id', $this->pro_id)->update([
            'code' => $this->code,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'Color Updated Successfully...');
        $this->emit('closemodal');

    }

    public function delete($id)
    {
        Color::Where('id', $id)->delete();
        session()->flash('success', 'Color Deleted Successfully...');
        $this->emit('closemodal');

    }
    public function render()
    {
        $data = Color::where('code', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.color.index', ['data'=>$data]);
    }
}
