<?php

namespace App\Http\Livewire\Admin\Bash;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\BadgeProduct;
use App\Models\Bash;
use App\Models\Product;

class Bashproducts extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $bash_id, $product_id;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    public function resetinputfields()
    {
        $this->selectedProducts = '';
        $this->bash_id = '';
    }

    public $selectedProducts = [];
    public $selectedProductNames = [];

    public function updatedSelectedProducts()
    {
        $this->selectedProductNames = [];
        foreach ($this->selectedProducts as $productId) {
            $productName = Product::find($productId)->name;
            $this->selectedProductNames[] = $productName;
        }
    }

    public function removeSelectedProduct($productName)
    {
        $key = array_search($productName, $this->selectedProductNames);
        if ($key !== false) {
            unset($this->selectedProductNames[$key]);
            unset($this->selectedProducts[$key]);
        }
    }

    public function submitSelectedProducts()
    {
        // Code to store the selected products in the database goes here.
        $this->selectedProducts = [];
        $this->selectedProductNames = [];
    }

    public function store()
    {
        $this->validate([
            'bash_id' => 'required',
            'selectedProducts' => 'required|array|min:1'
        ]);

        foreach ($this->selectedProducts as $productId) {
            BadgeProduct::create([
                'bash_id' => $this->bash_id,
                'product_id' => $productId
            ]);
        }

        $this->resetinputfields(['bash_id', 'selectedProducts']);
        session()->flash('success', 'Bash product added successfully.');
        $this->emit('closemodal');
    }

    public function deleteBashProduct($id)
    {
        $state = BadgeProduct::find($id);
        if ($state) {
            $this->bash_id = $state->id;

        } else {
            return redirect()->to('/admin/bash');
        }
    }

    public function delete()
    {
        BadgeProduct::Where('id', $this->bash_id)->delete();
        $this->resetinputfields();
        session()->flash('success', 'Bash Deleted Successfully...');
        $this->emit('closemodal');

    }

    public function render()
    {
        $data = BadgeProduct::whereHas('product', function ($query) {
            $query->where('style_code', 'like', '%' . $this->search . '%');
        })->orderByDesc('id')->paginate(10);
        $products = Product::get();
        $bash = Bash::get();
        return view('livewire.admin.bash.bashproducts', compact('data', 'products', 'bash'));
    }
}