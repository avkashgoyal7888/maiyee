<?php

namespace App\Http\Livewire\Admin\Exchange;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Exchange;
use App\Models\Order;
use Mail;

class Returns extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $ex_id, $status, $color, $return_payment_status;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'status' => 'required',
    ];
    protected $messages = [
        'status.required' => 'Status is required.....',
    ];

    public function resetinputfields()
    {
        $this->status = '';
        $this->ex_id = '';
        $this->order_id = '';
        $this->product_id = '';
        $this->size_id = '';
        $this->total = '';
        $this->user_id = '';
        $this->order_date = '';
        $this->created_at = '';
        $this->address = '';
    }

    public function viewDetailProduct($id)
    {
        $order = Exchange::find($id);
        if ($order) {
            $address = order::where('order_id', $order->order_id)->first();
            $this->order_id = $order->order_id;
            $this->product_id = $order->product->name;
            $this->size_id = $order->size->size;
            $this->total = $order->total;
            $this->user_id = $order->user->name;
            $this->order_date = $address->order_date;
            $this->created_at = $order->created_at->format('Y-m-d');
            $this->address = $address->address . ' ' . $address->landmark . ' ' . $address->state . ' ' . $address->city . ' ' . $address->pin_code . ' ' . $address->order_notes;
        } else {
            return redirect()->to('/admin/replace');
        }

    }

    public function editStatus($id)
    {
        $ex = Exchange::find($id);
        if ($ex) {
            $this->ex_id = $ex->id;
            $this->status = $ex->status;

        } else {
            return redirect()->to('/admin/return');
        }
    }

    public function update()
    {
        $validatedata = $this->validate();
        $exc = Exchange::Where('id', $this->ex_id)->first();
        $exc->status = $this->status;
        $exc->update();
        $orderid = $exc->order_id;
        $price = $exc->price;
        $hsn = $exc->product->hsn_code;
        $proname = $exc->product->name;
        $proimg = $exc->product->image;
        $email = $exc->user->email;
        $username = $exc->user->name;
        if ($this->status == '5') {
            Mail::send('admin.email.replace', ['orderid' => $orderid, 'hsn' => $hsn, 'proname' => $proname, 'price' => $price, 'proimg' => $proimg, 'username' => $username], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Replace/Replace Order');
            });
        }
        $this->resetinputfields();
        session()->flash('success', 'Status Updated Successfully...');
        $this->emit('closemodal');
    }

    public function returnPayment($id)
    {
        $ex = Exchange::find($id);
        if ($ex) {
            $this->ex_id = $ex->id;

        } else {
            return redirect()->to('/admin/product');
        }
    }

    public function returnPaymentUpdate()
    {
        $exc = Exchange::Where('id', $this->ex_id)->first();
        $exc->return_payment_status = '1';
        $exc->update();
        $orderid = $exc->order_id;
        $price = $exc->price;
        $hsn = $exc->product->hsn_code;
        $proname = $exc->product->name;
        $proimg = $exc->product->image;
        $email = $exc->user->email;
        $total = $exc->total;
        if ($exc->return_payment_status == '1') {
            Mail::send('admin.email.refund', ['orderid' => $orderid, 'hsn' => $hsn, 'proname' => $proname, 'price' => $price, 'proimg' => $proimg, 'total' => $total], function ($message) use ($email) {
                $message->to($email);
                $message->subject('Refund Approved');
            });
        }
        $this->resetinputfields();
        session()->flash('success', 'Updated Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = Exchange::where('order_id', 'like', '%' . $this->search . '%')->where('option', 'return')->orderByDesc('id')->paginate(10);
        $order = Order::where('order_id', $data->pluck('order_id')->toArray())
            ->first();
        return view('livewire.admin.exchange.returns', compact('data', 'order'));
    }
}