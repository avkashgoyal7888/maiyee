<?php

namespace App\Http\Livewire\Admin\Linkcategory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\LinkCategory;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $name, $image, $remark, $ex_id;
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
        $this->name = '';
        $this->remark = '';
        $this->image = '';
        $this->ex_id = '';
        $this->reset('image');

    }

    public function store()
    {
        $validatedata = $this->validate([
            'name' => 'required',
            'remark' => 'required',
            'image' => 'required|file|max:600',
        ]);
        if ($this->image != null) {
            $imageName = substr(uniqid(), 0, 9);
            $imgpath = $this->image->getRealPath();
            $image = Cloudinary::upload($imgpath, [
                'folder' => 'admin/linkcategory',
                'format' => 'webp',
                'public_id' => $imageName,
            ])->getSecurePath();
        }
        $link = new LinkCategory;
        $link->name = $this->name;
        $link->remark = $this->remark;
        $link->image = $image;
        $link->save();
        $this->resetinputfields();
        session()->flash('success', 'Added Successfully...');
        $this->emit('closemodal');
    }

    public function editCategory($id)
    {
        $link = LinkCategory::find($id);
        if ($link) {
            $this->ex_id = $link->id;
            $this->name = $link->name;
            $this->remark = $link->remark;
            $this->image = $link->image;

        } else {
            return redirect()->to('/admin/link-category');
        }
    }

    public function update()
    {
        $validatedata = $this->validate([
            'name' => 'required',
            'remark' => 'required',
            'image' => 'max:600',
        ]);
        $link = LinkCategory::find($this->ex_id);

        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            if ($link->image) {
                $publicId = pathinfo($link->image)['filename'];
                Cloudinary::destroy("admin/linkcategory/{$publicId}");
            }
            $imageName = substr(uniqid(), 0, 9);
            $imagepath = $this->image->getRealPath();
            $image = Cloudinary::upload($imagepath, [
                'folder' => 'admin/linkcategory',
                'format' => 'webp',
                'public_id' => $imageName,
            ])->getSecurePath();
        } else {
            $image = $link->image;
        }
        $link->name = $this->name;
        $link->remark = $this->remark;
        $link->image = $image;
        $link->update();
        $this->resetinputfields();
        session()->flash('success', 'Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteCategory($id)
    {
        $link = LinkCategory::find($id);
        if ($link) {
            $this->ex_id = $link->id;
        } else {
            return redirect()->to('/admin/link-category');
        }
    }

    public function delete()
    {
        $link = LinkCategory::where('id', $this->ex_id)->first();
        if ($link->image != null) {
            $publicId = pathinfo($link->image)['filename'];
            Cloudinary::destroy("admin/linkcategory/{$publicId}");
        }
        $link->delete();
        session()->flash('success', 'Congratulations !! Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = LinkCategory::where('name', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.linkcategory.index',compact('data'));
    }
}
