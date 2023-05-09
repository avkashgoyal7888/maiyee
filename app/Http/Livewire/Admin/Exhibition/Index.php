<?php

namespace App\Http\Livewire\Admin\Exhibition;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Exhibition;
use Livewire\WithFileUploads;

class Index extends Component
{

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $title, $ex_id,$image,$ex_date;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'title' => 'required',
    ];
    protected $messages = [
        'title.required' => 'Title is required.....',
    ];

    public function resetinputfields()
    {
        $this->title = '';
        $this->ex_id = '';
        $this->image = '';
        $this->ex_date = '';
        $this->reset('image');

    }

    public function store()
    {
        $validatedata = $this->validate([
            'image' => 'required',
            'title' => 'required',
            'ex_date' => 'required',
        ]);
        if ($this->image != '') {
            $image = substr(uniqid(), 0, 9) . '.' . $this->image->extension();
            $this->image->storeAs('admin/exhibition', $image, 'real_public');
        }
        $cat = new Exhibition;
        $cat->title = $this->title;
        $cat->ex_date = $this->ex_date;
        $cat->image = $image;
        $cat->save();
        $this->resetinputfields();
        session()->flash('success', 'Exhibition Added Successfully...');
        $this->emit('closemodal');
    }

    public function editCategory($id)
    {
        $cat = Exhibition::find($id);
        if ($cat) {
            $this->ex_id = $cat->id;
            $this->title = $cat->title;
            $this->image = $cat->image;
            $this->ex_date = $cat->ex_date;

        } else {
            return redirect()->to('/admin/exhibition');
        }
    }

    public function update()
    {
        $validatedata = $this->validate();
        $sub = Exhibition::find($this->ex_id);
    
        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            $ext = $this->image->getClientOriginalExtension();
            $name = substr(uniqid(), 0, 9) . '.' . $ext;
            $image = $name;
            $this->image->storeAs('admin/exhibition', $name, 'real_public');
            $image_path = public_path('admin/exhibition/' . $sub->image);
            unlink($image_path);
        } else {
            $image = $sub->image;
        }
    
        $sub->title = $this->title;
        $sub->ex_date = $this->ex_date;
        $sub->image = $image;
        $sub->update();
    
        $this->resetinputfields();
        session()->flash('success', 'Exhibition Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteCategory($id)
    {
        $exhibition = Exhibition::find($id);
        if ($exhibition) {
            $this->ex_id = $exhibition->id;

        } else {
            return redirect()->to('/admin/exhibition');
        }
    }

    public function delete()
    {
        $exhibition = Exhibition::where('id', $this->ex_id)->first();
        if ($exhibition->image != null) {
            $image_path = public_path('admin/exhibition/' . $exhibition->image);
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }
        $exhibition->delete();
        session()->flash('success', 'Congratulations !! Exhibition Deleted Successfully...');
        $this->emit('closemodal');
    } 
    public function render()
    {
        $data = Exhibition::where('title', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.exhibition.index',compact('data'));
    }
}
