<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\OrderDetail;
use App\Models\Order;
use Illuminate\Http\Request;
use DB;

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
        $quantity = OrderDetail::where('order_id', $this->order_id)->sum('quantity');
        $taxable = OrderDetail::where('order_id', $this->order_id)->sum('taxable');
        $gst = OrderDetail::where('order_id', $this->order_id)->sum('gst');
        $cgst = OrderDetail::where('order_id', $this->order_id)->sum('cgst');
        $sgst = OrderDetail::where('order_id', $this->order_id)->sum('sgst');
        $igst = OrderDetail::where('order_id', $this->order_id)->sum('igst');
        $total = OrderDetail::where('order_id', $this->order_id)->sum('total');
        $orders = Order::where('order_id', $this->order_id)->first();
        return view('livewire.admin.order.detail', compact('data', 'quantity', 'taxable', 'gst', 'cgst', 'sgst', 'igst', 'total', 'orders'));
    }
}