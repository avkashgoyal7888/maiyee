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
    public $ac_id, $coupon_code, $coupon_value, $type, $user_id, $quantity, $startDate, $endDate;
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
        'type' => 'required',
    ];
    protected $messages = [
        'coupon_value.required' => 'Coupon Value is required',
        'type.required' => 'Coupon Type is required',
    ];

    public function resetinputfields()
    {
        $this->coupon_value = '';
        $this->type = '';
        $this->quantity = '';
    }

    public function stores()
    {
        for ($i = 0; $i < $this->quantity; $i++) {
            $validatedata = $this->validate();
            $create = Auth::guard('admin')->user()->id;

            $store = new Coupon;
            $couponCode = Str::random(10);

            $store->coupon_code = $couponCode;
            $store->coupon_type = $this->type;
            $store->coupon_price = $this->coupon_value;
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
            $this->coupon_value = $acc->coupon_price;
            $this->type = $acc->coupon_type;

        } else {
            return redirect()->to('/admin/coupon');
        }

    }

    public function updateStore()
    {
        $validatedata = $this->validate();
        Coupon::Where('id', $this->ac_id)->update([
            'coupon_price' => $this->coupon_value,
            'coupon_type' => $this->type,
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
