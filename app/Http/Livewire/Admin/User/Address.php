<?php

namespace App\Http\Livewire\Admin\User;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\UserAddress;
use App\Models\User;
use Illuminate\Http\Request;
use DB;

class Address extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $short = 2;
    public $user_id;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(Request $req, $user_id)
    {
        $id = $req->id;
        $this->user_id = $id;
    }

    public function render()
    {
        $data = UserAddress::where('user_id', $this->user_id)->orderByDesc('id')->paginate(10);
        return view('livewire.admin.user.address', compact('data'));
    }
}