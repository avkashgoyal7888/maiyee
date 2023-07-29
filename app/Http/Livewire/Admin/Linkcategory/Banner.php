<?php

namespace App\Http\Livewire\Admin\Linkcategory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\LinkBanner;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Banner extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $short = 10;
    public $banr_id,$search,$title,$start_date,$end_date,$image,$status;
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
        $this->title = '';
        $this->start_date = '';
        $this->end_date = '';
        $this->image = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:1024', // 1MB = 1024 kilobytes
        ], [
            'title.required' => 'The Title field is required.',
            'image.required' => 'Please select an image.',
            'image.image' => 'The selected file must be an image.',
            'image.mimes' => 'The image must be in jpeg, jpg, webp or png format.',
            'image.max' => 'The image size should not exceed 1MB.',
        ]);


            if ($this->image != null) {
                $imageName = substr(uniqid(), 0, 9);
                $imgpath = $this->image->getRealPath();
                $image = Cloudinary::upload($imgpath, [
                    'folder' => 'admin/linkbanner',
                    'format' => 'webp',
                    'public_id' => $imageName,
                ])->getSecurePath();
            }

            $banner = new LinkBanner();
            $banner->title = $this->title;
            $banner->start_date = $this->start_date;
            $banner->end_date = $this->end_date;
            $banner->image = $image;
            $banner->save();

            $this->resetinputfields();
            session()->flash('success', 'Congratulations !! Banner Added Successfully...');
                $this->emit('closemodal');
    }

    public function editBanner($id)
    {
        $banner = LinkBanner::find($id);
        if ($banner) {
            $this->banr_id = $banner->id;
            $this->title = $banner->title;
            $this->start_date = $banner->start_date;
            $this->end_date = $banner->end_date;
            $this->image = $banner->image;
        } else {
            return redirect()->to('/admin/link-banner');
        }
    }

    public function update()
    {
        $validatedData = $this->validate([
            'title' => 'required',
        ], [
            'title.required' => 'The Title field is required.',
        ]);
        $banner = LinkBanner::where('id',$this->banr_id)->first();
            if ($this->image instanceof \Illuminate\Http\UploadedFile) {
                if ($banner->image) {
                    $publicId = pathinfo($banner->image)['filename'];
                    Cloudinary::destroy("admin/linkbanner/{$publicId}");
                }
                $imageName = substr(uniqid(), 0, 9);
                $imagepath = $this->image->getRealPath();
                $image = Cloudinary::upload($imagepath, [
                    'folder' => 'admin/linkbanner',
                    'format' => 'webp',
                    'public_id' => $imageName,
                ])->getSecurePath();
            } else {
                $image = $banner->image;
            }

            $banner->title = $this->title;
            $banner->start_date = $this->start_date;
            $banner->end_date = $this->end_date;
            $banner->image = $image;
            $banner->update();

        $this->resetinputfields();
        session()->flash('success', 'Congratulations !! Banner Updated Successfully...');
        $this->emit('closemodal');

    }

    public function deleteBanner($id)
    {
        $pr = LinkBanner::find($id);
        if ($pr) {
            $this->banr_id = $pr->id;
        } else {
            return redirect()->to('/admin/link-banner');
        }
    }

    public function toggleStatus($id)
    {
        $banner = LinkBanner::find($id);

        if ($banner) {
            $banner->status = $banner->status === '0' ? '1' : '0';
            $banner->save();
        }
    }

    public function delete()
    {
        $banner = LinkBanner::Where('id', $this->banr_id)->first();
        if ($banner->image != null) {
            $publicId = pathinfo($banner->image)['filename'];
            Cloudinary::destroy("admin/linkbanner/{$publicId}");
        }
        $banner->delete();
        $this->resetinputfields();
        session()->flash('success', 'Banner Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = LinkBanner::where('title', 'like', '%' . $this->search . '%')
            ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.linkcategory.banner',compact('data'));
    }
}
