<?php

namespace App\Http\Livewire\Admin\Color;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Color;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Index extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $color_id, $category_id, $subcategory_id, $subcategories, $category, $code, $product_id, $startDate, $endDate, $product, $color_category;
    public $image;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    public function mount()
    {
        $this->category = Category::all();
        $this->subcategories = collect();
        $this->product = collect(); // Initialize $this->product
        $category_id = $this->category_id;
    }

    public function updateSubcategories()
    {
        $this->subcategories = SubCategory::where('cat_id', $this->category_id)->get();
    }

    public function viewProduct()
    {
        if (!empty($this->product)) {
            $this->product = Product::where('sub_id', $this->subcategory_id)->get();
        }
    }

    public function resetinputfields()
    {
        $this->category_id = '';
        $this->subcategory_id = '';
        $this->product_id = '';
        $this->code = '';
        $this->image = '';
        $this->color_id = '';
        $this->color_category = '';
    }

    protected $rules = [
        'code' => 'required',
    ];

    protected $messages = [
        'code.required' => 'color Name is required',
    ];

    public function store()
    {
        $validatedData = $this->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'product_id' => 'required',
            'code' => 'required',
            'image' => 'required|image',
            'color_category' => 'required',
        ], [
                'category_id.required' => 'Select Category first.....',
                'subcategory_id.required' => 'Select Sub-Category first.....',
                'product_id.required' => 'Select Product first...',
                'code.required' => 'Color Name is required',
                'image.required' => 'Image is required',
                'image.image' => 'Only image files are allowed',
                'color_category.required' => 'Color Category is required....'
            ]);
        $image = $this->image;
        if ($image) {
            $imageName = substr(uniqid(), 0, 9);
            $imgpath = $this->image->getRealPath();
            $image = Cloudinary::upload($imgpath, [
                'folder' => 'admin/color',
                'public_id' => $imageName,
            ])->getSecurePath();
            $data = new Color;
            $data->product_id = $this->product_id;
            $data->code = $this->code;
            $data->image = $image;
            $data->color_category = $this->color_category;
            $data->save();
        }
        $this->resetinputfields();
        session()->flash('success', 'Congratulations!! Color Added Successfully...');
        $this->emit('closemodal');
    }

    public function editColor($id)
    {
        $clr = Color::find($id);
        if ($clr) {
            $this->color_id = $clr->id;
            $this->code = $clr->code;
            $this->image = $clr->image;
            $this->color_category = $clr->color_category;

        } else {
            return redirect()->to('/admin/products');
        }
    }

    public function updateColor()
    {
        $validatedata = $this->validate();
        $data = Color::find($this->color_id);
        $image = $data->image;
        if ($this->image && $this->image !== $data->image) {
            $publicId = pathinfo($data->image)['filename'];
            Cloudinary::destroy("admin/color/{$publicId}");
            $imageName = substr(uniqid(), 0, 9);
            $imagepath = $this->image->getRealPath();
            $image = Cloudinary::upload($imagepath, [
                'folder' => 'admin/color',
                'public_id' => $imageName,
            ])->getSecurePath();
        }
        Color::where('id', $this->color_id)->update([
            'code' => $this->code,
            'image' => $image,
            'color_category' => $this->color_category,
        ]);
        $this->resetinputfields();
        session()->flash('success', 'Color Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteColor($id)
    {
        $color = Color::find($id);
        if ($color) {
            $this->color_id = $color->id;

        } else {
            return redirect()->to('/admin/color');
        }
    }

    public function delete()
    {
        $clr = Color::where('id', $this->color_id)->first();

        if ($clr->image != null) {
            if ($clr->image != null) {
                $publicId = pathinfo($clr->image)['filename'];
                Cloudinary::destroy("admin/color/{$publicId}");
            }
        }
        $clr->delete();
        $this->resetinputfields();
        session()->flash('success', 'Congratulations !! Color Deleted Successfully...');
        $this->emit('closemodal');
    }

    public function render()
    {
        $data = Color::whereHas('product', function ($query) {
            $query->where('style_code', 'like', '%' . $this->search . '%');
        })->orderByDesc('id')->paginate(10);
        return view('livewire.admin.color.index', ['data' => $data]);
    }
}