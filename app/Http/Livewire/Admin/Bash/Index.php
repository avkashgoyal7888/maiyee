<?php

namespace App\Http\Livewire\Admin\Bash;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Bash;

class Index extends Component
{

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search, $name, $bash_id;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'name' => 'required',
    ];
    protected $messages = [
        'name.required' => 'Bash is required.....',
    ];

    public function resetinputfields()
    {
        $this->name = '';
        $this->bash_id = '';
    }

    public function store()
    {
        $validatedata = $this->validate();
        $state = new Bash;
        $state->name = $this->name;
        $state->save();
        $this->resetinputfields();
        session()->flash('success', 'Bash Added Successfully...');
        $this->emit('closemodal');
    }

    public function editState($id)
    {
        $state = Bash::find($id);
        if ($state) {
            $this->bash_id = $state->id;
            $this->name = $state->name;

        } else {
            return redirect()->to('/admin/states');
        }

    }

    public function update()
    {
        $validatedata = $this->validate();
        Bash::Where('id', $this->bash_id)->update([
            'name' => $this->name,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'Bash Updated Successfully...');
        $this->emit('closemodal');

    }

    public function deleteState($id)
    {
        $state = Bash::find($id);
        if ($state) {
            $this->bash_id = $state->id;

        } else {
            return redirect()->to('/admin/bash');
        }
    }

    public function delete()
    {
        Bash::Where('id', $this->bash_id)->delete();
        $this->resetinputfields();
        session()->flash('success', 'Bash Deleted Successfully...');
        $this->emit('closemodal');

    }

    public function render()
    {
        $data = Bash::where('name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.bash.index', compact('data'));
    }
}
