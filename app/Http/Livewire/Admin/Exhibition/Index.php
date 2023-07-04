<?php

namespace App\Http\Livewire\Admin\Exhibition;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\exhibition;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{

    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $title, $ex_id, $image, $ex_date;
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
        if ($this->image != null) {
            $imageName = substr(uniqid(), 0, 9);
            $imgpath = $this->image->getRealPath();
            $image = Cloudinary::upload($imgpath, [
                'folder' => 'admin/exhibition',
                'public_id' => $imageName,
            ])->getSecurePath();
        }
        $cat = new exhibition;
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
        $cat = exhibition::find($id);
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
        $sub = exhibition::find($this->ex_id);

        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            if ($sub->image) {
                $publicId = pathinfo($sub->image)['filename'];
                Cloudinary::destroy("admin/exhibition/{$publicId}");
            }
            $imageName = substr(uniqid(), 0, 9);
            $imagepath = $this->image->getRealPath();
            $image = Cloudinary::upload($imagepath, [
                'folder' => 'admin/exhibition',
                'public_id' => $imageName,
            ])->getSecurePath();
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
        $exhibition = exhibition::find($id);
        if ($exhibition) {
            $this->ex_id = $exhibition->id;
        } else {
            return redirect()->to('/admin/exhibition');
        }
    }

    public function delete()
    {
        $exhibition = exhibition::where('id', $this->ex_id)->first();
        if ($exhibition->image != null) {
            $publicId = pathinfo($exhibition->image)['filename'];
            Cloudinary::destroy("admin/exhibition/{$publicId}");
        }
        $exhibition->delete();
        session()->flash('success', 'Congratulations !! Exhibition Deleted Successfully...');
        $this->emit('closemodal');
    }
    public function render()
    {
        $data = exhibition::where('title', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.exhibition.index', compact('data'));
    }
}