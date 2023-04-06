<?php

namespace App\Http\Livewire\Admin\Supplier;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\SupplierAccount;
use App\Models\Supplier;
use Illuminate\Http\Request;

class Account extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $startDate, $endDate;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public $supl_id;

    public function mount(Request $req, $supl_id)
    {

        $id = $req->id;

        $this->supl_id = $id;

    }
    public function render()
    {
        $data = SupplierAccount::where('supplier_id', $this->supl_id)
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('supplier_id', 'like', '%' . $this->search . '%');
                }
            })
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.supplier.account',['data'=>$data]);
    }
}
