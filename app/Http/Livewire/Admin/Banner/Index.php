<?php

namespace App\Http\Livewire\Admin\Banner;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Banner;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search, $image, $tag;
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
        $this->image = '';
        $this->tag = '';
    }

    public function store()
    {   
            $validatedata = $this->validate([   
                'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Add image validation     rules
            ]);

            if ($this->image != '') {
            $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
            $this->image->storeAs('admin/banner', $image, 'real_public');
        }

            $banner = new Banner;
            $banner->tag = $this->tag;
            $banner->image = $image;
            $banner->save();
    
            $this->resetinputfields();
            session()->flash('success', 'Congratulations !! Banner Added Successfully...');
            $this->emit('closemodal');
    }
    public function delete($id)
    {
        $banner = Banner::Where('id', $id)->first();
        unlink(public_path('admin/banner/' . $banner->image));
        $banner->delete();
        session()->flash('success', 'Congratulations !! Banner Deleted Successfully...');
        $this->emit('closemodal');

    }
    public function render()
    {
        $data = Banner::where('image', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.banner.index', compact('data'));
    }
}
