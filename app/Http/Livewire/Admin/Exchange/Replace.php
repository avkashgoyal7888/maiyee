<?php

namespace App\Http\Livewire\Admin\Exchange;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Exchange;
use App\Models\Order;
use Mail;

class Replace extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $ex_id, $status, $color;
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

//     return and exchange page date->Order_datefromorders->username->product->order_valuewillbetotal->status->


// status->0 requested 1 accepted 2 pickup 3 dispatch 4 reject ->action view and edit -

// view -> order_id order_data-> exchange_date->name->product->value
// textare->address
//  edit-> change status

    public function viewDetailProduct($id)
    {
        $order = Exchange::find($id);
        if ($order) {
            $address = order::where('order_id',$order->order_id)->first();
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

    public function editState($id)
    {
        $ex = Exchange::find($id);
        if ($ex) {
            $this->ex_id = $ex->id;
            $this->status = $ex->status;

        } else {
            return redirect()->to('/admin/replace');
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
            $email = $exc->user->email;

        if ($this->status == '5') {
            Mail::send('admin.email.replace', ['orderid' => $orderid,'hsn'=>$hsn,'proname'=>$proname,'price'=>$price], function ($message) use ($email) {
            $message->to($email);
            $message->subject('Replace/Replace Order');
        });
        }

        $this->resetinputfields();
        session()->flash('success', 'Status Updated Successfully...');
        $this->emit('closemodal');

    }
    public function render()
    {
        $data = Exchange::where('order_id', 'like', '%'.$this->search.'%')->where('option', 'replace')->orderByDesc('id')->paginate(10);
        $order = Order::where('order_id', $data->pluck('order_id')->toArray())
        ->first();
        return view('livewire.admin.exchange.replace',compact('data','order'));
    }
}
