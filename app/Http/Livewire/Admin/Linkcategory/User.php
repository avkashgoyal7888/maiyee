<?php

namespace App\Http\Livewire\Admin\Linkcategory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\LinkUser;

class User extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $data = LinkUser::where('name', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.linkcategory.user',compact('data'));
    }
}
