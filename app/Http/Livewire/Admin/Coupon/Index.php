<?php

namespace App\Http\Livewire\Admin\Coupon;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Coupon;
use Illuminate\Support\Str;
use Auth;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search = '';
    public $ac_id, $coupon_code, $coupon_value, $coupon_type, $user_id, $quantity,$exp_date,$order_value,$type;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'coupon_value' => 'required',
        'coupon_type' => 'required',
        'type' => 'required',
    ];
    protected $messages = [
        'coupon_value.required' => 'Coupon Value is required',
        'coupon_type.required' => 'Coupon Type is required',
        'type.required' => 'Type is required',
    ];

    public function resetinputfields()
    {
        $this->coupon_value = '';
        $this->coupon_type = '';
        $this->type = '';
        $this->quantity = '';
        $this->exp_date = '';
        $this->order_value = '';
    }

    public function stores()
    {
        for ($i = 0; $i < $this->quantity; $i++) {
            $validatedata = $this->validate();
            $create = Auth::guard('admin')->user()->id;

            $store = new Coupon;
            $couponCode = Str::random(10);

            $store->coupon_code = $couponCode;
            $store->coupon_type = $this->coupon_type;
            $store->type = $this->type;
            $store->coupon_price = $this->coupon_value;
            $store->exp_date = $this->exp_date;
            $store->order_value = $this->order_value;
            $store->created_by = $create;
            $store->save();

        }
        $this->resetinputfields();
        session()->flash('success', 'Coupon Added Successfully...');
        $this->emit('closemodal');
    }

    public function editStore($id)
    {
        $acc = Coupon::find($id);
        if ($acc) {
            $this->ac_id = $acc->id;
            $this->coupon_code = $acc->coupon_code;
            $this->coupon_value = $acc->coupon_price;
            $this->coupon_type = $acc->coupon_type;
            $this->type = $acc->type;
            $this->exp_date = $acc->exp_date;
            $this->order_value = $acc->order_value;

        } else {
            return redirect()->to('/admin/coupon');
        }

    }

    public function updateStore()
    {
        $validatedata = $this->validate();
        Coupon::Where('id', $this->ac_id)->update([
            'coupon_code' => $this->coupon_code,
            'coupon_price' => $this->coupon_value,
            'coupon_type' => $this->coupon_type,
            'type' => $this->type,
            'exp_date' => $this->exp_date,
            'order_value' => $this->order_value,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'Coupon Updated Successfully...');
        $this->emit('closemodal');

    }

    public function delete($id)
    {
        Coupon::Where('id', $id)->delete();
        session()->flash('success', 'Coupon Deleted Successfully...');
        $this->emit('closemodal');

    }

    public function render()
    {
        $data = Coupon::where('coupon_code', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.coupon.index', compact('data'));
    }
}
