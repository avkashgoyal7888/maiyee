<?php

namespace App\Http\Livewire\Admin\Linkcategory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\LinkCategory;
use App\Models\LinkProduct;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Products extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $link_id,$product_name,$style_code,$mrp,$selling_price,$image;
    public $fields = [
        ['product_name' => '', 'style_code'=>'' ,'mrp'=>'','selling_price'=>'','image'=>''],
    ];
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function addField()
    {
        $this->fields[] = ['product_name' => '','style_code'=>'','mrp'=>'','selling_price'=>'','image'=>''];
    }

    public function removeField($index)
    {
        unset($this->product_name[$index]);
        unset($this->style_code[$index]);
        unset($this->mrp[$index]);
        unset($this->selling_price[$index]);
        unset($this->image[$index]);
        $this->product_name = array_values($this->product_name);
        $this->style_code = array_values($this->style_code);
        $this->mrp = array_values($this->mrp);
        $this->selling_price = array_values($this->selling_price);
        $this->image = array_values($this->image);
    }

    public function mount()
    {
        $this->category = LinkCategory::all();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'link_id' => 'required',
        'product_name' => 'required',
        'style_code' => 'required',
        'mrp' => 'required',
        'selling_price' => 'required',
    ];
    protected $messages = [
        'link_id.required' => 'This Field is required',
        'product_name.required' => 'This Field is required',
        'style_code.required' => 'This Field is required',
        'mrp.required' => 'This Field is required',
        'selling_price.required' => 'This Field is required',
    ];

    public function resetinputfields()
    {
        $this->link_id = '';
        $this->product_name = '';
        $this->style_code = '';
        $this->mrp = '';
        $this->selling_price = '';
        $this->image = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'link_id' => 'required',
            'fields.*.product_name' => 'required',
            'fields.*.style_code' => 'required',
            'fields.*.mrp' => 'required',
            'fields.*.selling_price' => 'required',
            'fields.*.image' => 'required|file|max:600',
        ],[
            'fields.*.image.max'=>'Image Size can not be more then 600kb',
        ]);

        foreach ($validatedData['fields'] as $key => $value) {
            $image = $value['image'];
            if ($image) {
                $imageName = substr(uniqid(), 0, 9);
                $imgpath = $image->getRealPath();
                $images = Cloudinary::upload($imgpath, [
                    'folder' => 'admin/linkproduct',
                    'format' => 'webp',
                    'public_id' => $imageName,
                ])->getSecurePath();
                }
                $data = new LinkProduct;
                $data->link_id = $validatedData['link_id'];
                $data->product_name = $value['product_name'];
                $data->style_code = $value['style_code'];
                $data->mrp = $value['mrp'];
                $data->selling_price = $value['selling_price'];
                $data->image = $images;
                $data->save();
        }
        $this->reset('link_id', 'product_name', 'style_code','mrp','selling_price','image', 'fields');
        session()->flash('success', 'Congratulations !! Added Successfully...');
        $this->emit('closemodal');
    }

    public function editProduct($id)
    {
        $link = LinkProduct::find($id);
        if ($link) {
            $this->sub_id = $link->id;
            $this->link_id = $link->link_id;
            $this->product_name = $link->product_name;
            $this->style_code = $link->style_code;
            $this->mrp = $link->mrp;
            $this->selling_price = $link->selling_price;
            $this->image = $link->image;
        } else {
            return redirect()->to('/admin/link-product');
        }
    }

    public function update()
    {
        $validatedata = $this->validate();
        $link = LinkProduct::find($this->sub_id);
        if ($this->image instanceof \Illuminate\Http\UploadedFile) {
            if ($link->image) {
                $publicId = pathinfo($link->image)['filename'];
                Cloudinary::destroy("admin/linkproduct/{$publicId}");
            }
            $imageName = substr(uniqid(), 0, 9);
            $imagepath = $this->image->getRealPath();
            $image = Cloudinary::upload($imagepath, [
                'folder' => 'admin/linkproduct',
                'public_id' => $imageName,
            ])->getSecurePath();
        } else {
            $image = $link->image;
        }
        $link->link_id = $this->link_id;
        $link->product_name = $this->product_name;
        $link->style_code = $this->style_code;
        $link->mrp = $this->mrp;
        $link->selling_price = $this->selling_price;
        $link->image = $image;
        $link->update();
        $this->resetinputfields();
        session()->flash('success', 'Congratulations !! Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteProduct($id)
    {
        $link = LinkProduct::find($id);
        if ($link) {
            $this->sub_id = $link->id;
        } else {
            return redirect()->to('/admin/link-product');
        }
    }

    public function delete()
    {
        $link = LinkProduct::where('id', $this->sub_id)->first();
        if ($link->image != null) {
            $publicId = pathinfo($link->image)['filename'];
            Cloudinary::destroy("admin/linkproduct/{$publicId}");
        }
        $link->delete();
        session()->flash('success', 'Congratulations !! Deleted Successfully...');
        $this->emit('closemodal');
    }
    public function render()
    {
        $data = LinkProduct::whereHas('cat', function ($query) {
        $query->where('name', 'like', '%' . $this->search . '%')
          ->orWhere('product_name', 'like', '%' . $this->search . '%')
          ->orWhere('style_code', 'like', '%' . $this->search . '%')
          ->orWhere('mrp', 'like', '%' . $this->search . '%')
          ->orWhere('selling_price', 'like', '%' . $this->search . '%');
        })->orderByDesc('id')->paginate(10);
        return view('livewire.admin.linkcategory.products',compact('data'));
    }
}
