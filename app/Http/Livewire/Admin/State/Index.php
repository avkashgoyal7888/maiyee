<?php

namespace App\Http\Livewire\Admin\State;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\State;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $state_name, $state_id;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'state_name' => 'required',
    ];
    protected $messages = [
        'state_name.required' => 'State is required.....',
    ];

    public function resetinputfields()
    {
        $this->state_name = '';
        $this->state_id = '';
    }

    public function store()
    {
        $validatedata = $this->validate();

        $state = new State;

        $state->state_name = $this->state_name;

        $state->save();

        $this->resetinputfields();
        session()->flash('success', 'State Added Successfully...');
        $this->emit('closemodal');
    }

    public function editState($id)
    {
        $state = State::find($id);
        if ($state) {
            $this->state_id = $state->id;
            $this->state_name = $state->state_name;

        } else {
            return redirect()->to('/admin/states');
        }

    }

    public function update()
    {
        $validatedata = $this->validate();
        State::Where('id', $this->state_id)->update([
            'state_name' => $this->state_name,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'State Updated Successfully...');
        $this->emit('closemodal');

    }

    public function deleteState($id)
    {
        $state = State::find($id);
        if ($state) {
            $this->state_id = $state->id;

        } else {
            return redirect()->to('/admin/state');
        }
    }

    public function delete()
    {
        State::Where('id', $this->state_id)->delete();
        $this->resetinputfields();
        session()->flash('success', 'State Deleted Successfully...');
        $this->emit('closemodal');

    }
    public function render()
    {
        $data = State::where('state_name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.state.index', ['data'=>$data]);
    }
}
