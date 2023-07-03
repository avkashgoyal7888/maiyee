<?php

namespace App\Http\Livewire\Admin\Banner;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\HomeBanner;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Home extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search, $image, $banner_id;
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
    }

    public function store()
    {   
            $validatedata = $this->validate([   
                'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            ],[
                'image.required' => 'Image can not be blank...',
            ]);

            if ($this->image != '') {
                $imgpath = $this->image->getRealPath();
                $image = Cloudinary::upload($imgpath, [
                    'folder' => 'admin/banner',
                ]);
            }

            $banner = new HomeBanner;
            $banner->image = $image->getSecurePath();
            $banner->save();
    
            $this->resetinputfields();
            session()->flash('success', 'Congratulations !! Banner Added Successfully...');
            $this->emit('closemodal');
    }

    public function deleteBanner($id)
    {
        $banner = HomeBanner::find($id);
        if ($banner) {
            $this->banner_id = $banner->id;

        } else {
            return redirect()->to('/admin/banner');
        }

    }
    public function delete()
    {
        $banner = HomeBanner::where('id', $this->banner_id)->first();
    
        if ($banner->image != null) {
            $publicId = pathinfo($banner->image)['filename'];
                Cloudinary::destroy("admin/banner/{$publicId}");
        }
        $banner->delete();
        session()->flash('success', 'Congratulations !! Banner Deleted Successfully...');
        $this->emit('closemodal');
    }
    public function render()
    {
        $data = HomeBanner::where('image', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.banner.home', compact('data'));
    }
}
