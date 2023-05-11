<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Order;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $state_name, $state_id;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $data = Order::where('name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.order.index', compact('data'));
    }
}
