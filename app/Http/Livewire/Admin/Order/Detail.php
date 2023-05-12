<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class Detail extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $short = 2;
    public $order_id, $startDate, $endDate;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(Request $req, $order_id)
    {
        $id = $req->id;
        $this->order_id = $id;
    }
    public function render()
    {
        $data = OrderDetail::where('order_id', $this->order_id)->orderByDesc('id')->paginate(10);
        return view('livewire.admin.order.detail',compact('data'));
    }
}
