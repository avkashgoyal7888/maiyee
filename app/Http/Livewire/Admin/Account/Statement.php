<?php

namespace App\Http\Livewire\Admin\Account;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\AccountStatement;
use App\Models\Account;
use Illuminate\Http\Request;
use DB;

class Statement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $short = 2;
    public $search;
    public $acc_id, $startDate, $endDate;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(Request $req, $acc_id)
    {
        $id = $req->id;
        $this->acc_id = $id;
    }

    public function render()
    {
        $data = AccountStatement::where('account_id', $this->acc_id)
            ->where(function ($query) {
                if ($this->search) {
                    $query->where('supplier_id', 'like', '%' . $this->search . '%');
                }
            })
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.account.statement', ['data'=>$data]);
    }
}
