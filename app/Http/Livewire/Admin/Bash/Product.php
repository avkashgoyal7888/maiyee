<?php

namespace App\Http\Livewire\Admin\Bash;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\BashProduct;
class Product extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $name, $bash_id;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }
    public function render()
    {
        $data = BashProduct::where('name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.bash.product');
    }
}
