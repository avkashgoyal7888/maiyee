<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\User;
use App\Models\Order;
use Auth;
use DB;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$name,$number,$email;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = User::where('name', 'like', '%'.$this->search.'%')
                    ->orderByDesc('id')->paginate(10);

        $orderTotal = Order::whereIn('user_id', $data->pluck('id'))->sum('payable');
        return view('livewire.admin.user.index',compact('data', 'orderTotal'));
    }
}
