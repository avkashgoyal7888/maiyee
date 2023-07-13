<?php

namespace App\Http\Livewire\Admin\Wardrobe;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Wardrobe;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $style_code, $wr_id, $image, $remarks;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'style_code' => 'required',
    ];
    protected $messages = [
        'style_code.required' => ' is required.....',
    ];

    public function resetinputfields()
    {
        $this->style_code = '';
        $this->wr_id = '';
        $this->image = '';
        $this->remarks = '';
        $this->reset('image');

    }

    public function store()
    {
        $validatedata = $this->validate([
            'image' => 'required',
            'style_code' => 'required',
            'remarks' => 'required',
        ]);
        if ($this->image != null) {
            $imageName = substr(uniqid(), 0, 9);
            $imgpath = $this->image->getRealPath();
            $image = Cloudinary::upload($imgpath, [
                'folder' => 'admin/wardrobe',
                'public_id' => $imageName,
            ])->getSecurePath();
        }
        $war = new Wardrobe;
        $war->style_code = $this->style_code;
        $war->remarks = $this->remarks;
        $war->image = $image;
        $war->save();
        $this->resetinputfields();
        session()->flash('success', 'Wardrobe Added Successfully...');
        $this->emit('closemodal');
    }

    public function editWardrobe($id)
    {
        $war = Wardrobe::find($id);
        if ($war) {
            $this->wr_id = $war->id;
            $this->style_code = $war->style_code;
            $this->image = $war->image;
            $this->remarks = $war->remarks;

        } else {
            return redirect()->to('/admin/wardrobe');
        }
    }

    public function update()
    {
        $validatedata = $this->validate();
        $war = Wardrobe::find($this->wr_id);

        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            if ($war->image) {
                $publicId = pathinfo($war->image)['filename'];
                Cloudinary::destroy("admin/wardrobe/{$publicId}");
            }
            $imageName = substr(uniqid(), 0, 9);
            $imagepath = $this->image->getRealPath();
            $image = Cloudinary::upload($imagepath, [
                'folder' => 'admin/wardrobe',
                'public_id' => $imageName,
            ])->getSecurePath();
        } else {
            $image = $war->image;
        }
        $war->style_code = $this->style_code;
        $war->remarks = $this->remarks;
        $war->image = $image;
        $war->update();
        $this->resetinputfields();
        session()->flash('success', 'Wardrobe Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteWardrobe($id)
    {
        $war = Wardrobe::find($id);
        if ($war) {
            $this->wr_id = $war->id;
        } else {
            return redirect()->to('/admin/wardrobe');
        }
    }

    public function delete()
    {
        $war = Wardrobe::where('id', $this->wr_id)->first();
        if ($war->image != null) {
            $publicId = pathinfo($war->image)['filename'];
            Cloudinary::destroy("admin/wardrobe/{$publicId}");
        }
        $war->delete();
        session()->flash('success', 'Congratulations !! Wardrobe Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = Wardrobe::where('style_code', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.wardrobe.index',compact('data'));
    }
}
