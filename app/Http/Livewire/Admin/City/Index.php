<?php

namespace App\Http\Livewire\Admin\City;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\City;
use App\Models\State;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $city_name, $state_id, $city_id;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->state = State::all();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'state_id' => 'required',
        'city_name' => 'required',
    ];
    protected $messages = [
        'state_id.required' => 'State is required',
        'city_name.required' => 'City is required.....',
    ];

    public function resetinputfields()
    {
        $this->city_name = '';
        $this->state_id = '';
        $this->city_id = '';
    }

    public function store()
    {
        $validatedata = $this->validate();
        $city = new City;
        $city->state_id = $this->state_id;
        $city->city_name = $this->city_name;
        $city->save();
        $this->resetinputfields();
        session()->flash('success', 'City Added Successfully...');
        $this->emit('closemodal');
    }

    public function editCity($id)
    {
        $city = City::find($id);
        if ($city) {
            $this->city_id = $city->id;
            $this->state_id = $city->state_id;
            $this->city_name = $city->city_name;

        } else {
            return redirect()->to('/admin/city');
        }
    }

    public function update()
    {
        $validatedata = $this->validate();
        City::Where('id', $this->sub_id)->update([
            'state_id' => $this->state_id,
            'city_name' => $this->city_name,
        ]);
        $this->resetinputfields();
        session()->flash('success', 'City Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteCity($id)
    {
        $city = City::find($id);
        if ($city) {
            $this->city_id = $city->id;

        } else {
            return redirect()->to('/admin/city');
        }
    }

    public function delete()
    {
        City::Where('id', $this->city_id)->delete();
        $this->resetinputfields();
        session()->flash('success', 'City Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = City::where('city_name', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        $state = State::all();
        return view('livewire.admin.city.index', ['data' => $data, 'state' => $state]);
    }
}