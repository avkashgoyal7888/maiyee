<?php

namespace App\Http\Livewire\Admin\Order;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Order;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $user_id,$name,$contact,$email,$order_date,$address,$landmark,$state,$city,$order_notes,$taxable,$cgst,$sgst,$igst,$total,$discount,$coupon_code,$shipping_charges,$payable,$payment_method,$order_status,$pick_id,$order_pickup;
    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function closemodal()
    {
        $this->resetinputfields();
    }

    public function editPickup($id)
    {
        $pick = Order::find($id);
        if ($pick) {
            $this->pick_id = $pick->id;
            $this->order_pickup = $pick->order_pickup;

        } else {
            return redirect()->to('/admin/order');
        }
    }

    public function updatePickup()
    {
        Order::Where('id', $this->pick_id)->update([
            'order_pickup' => $this->order_pickup,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'Updated Successfully...');
        $this->emit('closemodal');

    }

    public function resetinputfields()
    {
        $this->order_id = '';
        $this->user_id = '';
        $this->name = '';
        $this->contact = '';
        $this->email = '';
        $this->order_date = '';
        $this->address = '';
        $this->landmark = '';
        $this->state = '';
        $this->city = '';
        $this->order_notes = '';
        $this->taxable = '';
        $this->cgst = '';
        $this->sgst = '';
        $this->igst = '';
        $this->total = '';
        $this->discount = '';
        $this->coupon_code = '';
        $this->shipping_charges = '';
        $this->payable = '';
        $this->payment_method = '';
        $this->order_status = '';
        $this->pick_id = '';
        $this->order_pickup = '';
    }

    public function viewDetailProduct($id)
    {
        $order = Order::find($id);
        if ($order) {
            $this->order_id = $order->order_id;
            $this->user_id = $order->user->name;
            $this->name = $order->name;
            $this->contact = $order->contact;
            $this->email = $order->email;
            $this->order_date = $order->order_date;
            $this->address = $order->address;
            $this->landmark = $order->landmark;
            $this->state = $order->state;
            $this->city = $order->city;
            $this->order_notes = $order->order_notes;
            $this->taxable = $order->taxable;
            $this->cgst = $order->cgst;
            $this->sgst = $order->sgst;
            $this->igst = $order->igst;
            $this->total = $order->total;
            $this->discount = $order->discount;
            $this->coupon_code = $order->coupon_code;
            $this->shipping_charges = $order->shipping_charges;
            $this->payable = $order->payable;
            $this->payment_method = $order->payment_method;
            $this->order_status = $order->order_status;

        } else {
            return redirect()->to('/admin/order');
        }

    }
    public function render()
    {
        $data = Order::where('name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.order.index', compact('data'));
    }
}
