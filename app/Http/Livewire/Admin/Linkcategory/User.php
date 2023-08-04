<?php

namespace App\Http\Livewire\Admin\Linkcategory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\LinkUser;

class User extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search,$status;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    public function resetinputfields()
    {
        $this->status = '';
    }

    public function editStatus($id)
    {
        $pick = LinkUser::find($id);
        if ($pick) {
            $this->user_id = $pick->id;
            $this->status = $pick->status;

        } else {
            return redirect()->to('/admin/link-user');
        }
    }

    public function update()
    {
        LinkUser::Where('id', $this->user_id)->update([
            'status' => $this->status,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'Updated Successfully...');
        $this->emit('closemodal');

    }

    public function render()
    {
        $data = LinkUser::where('name', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.linkcategory.user',compact('data'));
    }
}
