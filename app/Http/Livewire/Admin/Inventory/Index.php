<?php

namespace App\Http\Livewire\Admin\Inventory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Inventory;
use Illuminate\Http\Request;
use DB;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $short = 2;
    public $search, $startDate, $endDate;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = Inventory::where('remarks', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.inventory.index', compact('data'));
    }
}
