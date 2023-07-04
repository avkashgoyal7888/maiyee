<?php

namespace App\Http\Livewire\Admin\Supplier;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Supplier;
use App\Models\State;
use App\Models\City;
use Auth;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    public $supplier_id, $sname, $name, $number, $email, $gst, $account, $bank, $ifsc, $address, $adminid, $role, $admin, $state_id, $city_id, $state, $city;

    public function mount()
    {
        $this->state = State::all();
        $this->city = collect();
        $state_id = $this->state_id;

    }

    public function updateCities()
    {
        $this->city = City::where('state_id', $this->state_id)->get();
    }

    public function viewCities()
    {
        $this->city = City::where('state_id', $this->state_id)->get();
        if ($this->city_id && !$this->city->contains('id', $this->city_id)) {
            $this->city_id = null;
        }
    }

    protected $rules = [
        'sname' => 'required',
        'name' => 'required',
        'number' => 'required|numeric',
        'email' => 'required|email',
        'gst' => 'required',
        'account' => 'required',
        'bank' => 'required',
        'ifsc' => 'required',
        'address' => 'required',
        'state_id' => 'required',
        'city_id' => 'required'
    ];
    protected $messages = [
        'sname.required' => 'This field can to be empty',
        'name.required' => 'This field can to be empty',
        'number.required' => 'Please enter a valid mobile number',
        'email.required' => 'This field can to be empty',
        'gst.required' => 'This field can to be empty',
        'account.required' => 'This field can to be empty',
        'bank.required' => 'This field can to be empty',
        'ifsc.required' => 'This field can to be empty',
        'address.required' => 'This field can to be empty',
        'state_id.required' => 'This field can to be empty',
        'city_id.required' => 'This field can to be empty'
    ];

    public function resetinputfields()
    {
        $this->sname = '';
        $this->name = '';
        $this->number = '';
        $this->email = '';
        $this->gst = '';
        $this->account = '';
        $this->bank = '';
        $this->ifsc = '';
        $this->address = '';
        $this->state_id = '';
        $this->city_id = '';
    }

    public function store()
    {
        $validatedata = $this->validate();
        $supplier_id = mt_rand(11111111, 99999999);
        $adminid = Auth::guard('admin')->user()->id;
        $supplier = new Supplier;
        $supplier->sname = $this->sname;
        $supplier->state_id = $this->state_id;
        $supplier->city_id = $this->city_id;
        $supplier->supplier_id = $supplier_id;
        $supplier->name = $this->name;
        $supplier->number = $this->number;
        $supplier->email = $this->email;
        $supplier->gst = $this->gst;
        $supplier->bank_number = $this->account;
        $supplier->bank_name = $this->bank;
        $supplier->address = $this->address;
        $supplier->ifsc = $this->ifsc;
        $supplier->created_by = $adminid;
        $supplier->updated_by = $adminid;
        $supplier->save();
        $this->resetinputfields();
        session()->flash('success', 'Congratulations !! Supplier Added Successfully...');
        $this->emit('closemodal');
    }

    public function editsupplier(int $supplier_id)
    {
        $supplier = Supplier::find($supplier_id);
        if ($supplier) {
            $this->supplier_id = $supplier->id;
            $this->sname = $supplier->sname;
            $this->name = $supplier->name;
            $this->email = $supplier->email;
            $this->number = $supplier->number;
            $this->address = $supplier->address;
            $this->gst = $supplier->gst;
            $this->account = $supplier->bank_number;
            $this->bank = $supplier->bank_name;
            $this->ifsc = $supplier->ifsc;
            $this->state_id = $supplier->state_id;
            $this->city_id = $supplier->city_id;
            $this->viewCities(); // Update city list and pre-select city
        } else {
            return redirect()->to('/admin/supplier');
        }
    }

    public function update()
    {
        $validatedata = $this->validate();
        $adminid = Session::get('adminid');
        Supplier::Where('id', $this->supplier_id)->update([
            'sname' => $this->sname,
            'name' => $this->name,
            'number' => $this->number,
            'email' => $this->email,
            'gst' => $this->gst,
            'bank_number' => $this->account,
            'bank_name' => $this->bank,
            'address' => $this->address,
            'ifsc' => $this->ifsc,
            'state_id' => $this->state_id,
            'city_id' => $this->city_id,
            'updated_by' => $adminid
        ]);
        $this->resetinputfields();
        session()->flash('success', 'Supplier Updated Successfully...');
        $this->emit('closemodal');
    }

    public function viewsupplier(int $supplier_id)
    {
        $supplier = Supplier::find($supplier_id);
        if ($supplier) {
            $this->supplier_id = $supplier->id;
            $this->sname = $supplier->sname;
            $this->name = $supplier->name;
            $this->email = $supplier->email;
            $this->number = $supplier->number;
            $this->address = $supplier->address;
            $this->gst = $supplier->gst;
            $this->account = $supplier->bank_number;
            $this->bank = $supplier->bank_name;
            $this->state_id = $supplier->state->state_name;
            $this->city_id = $supplier->city->city_name;
            $this->ifsc = $supplier->ifsc;
        } else {
            return redirect()->to('/admin/suppliers');
        }
    }

    public function deleteSupplier($id)
    {
        $supplier = supplier::find($id);
        if ($supplier) {
            $this->supplier_id = $supplier->id;
        } else {
            return redirect()->to('/admin/state');
        }
    }

    //Function to delete record

    public function delete()
    {
        Supplier::Where('id', $this->supplier_id)->delete();
        $this->resetinputfields();
        session()->flash('success', 'Supplier Deleted Successfully...');
        $this->emit('closemodal');

    }

    public function render()
    {
        $data = supplier::where('sname', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.supplier.index', ['data' => $data]);
    }
}