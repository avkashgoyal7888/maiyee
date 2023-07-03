<?php

namespace App\Http\Livewire\Admin\Color;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Color;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\ProductImage;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Image extends Component
{
    use WithPagination;
    use WithFileUploads;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $pro_id,$category_id, $subcategory_id, $subcategories, $category, $color, $product_id, $color_id,$product,$colordelete_id;
    public $image;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    public $fields;

    public function __construct()
    {
        $this->fields = [[ 'image' => '']];
    }

    public function addField()
    {
        $this->fields[] = ['image' => null];
    }

    public function removeField($index)
    {
        unset($this->fields[$index]);
        $this->fields = array_values($this->fields);
    }

    public function mount()
    {
        $this->category = Category::all();
        $this->subcategories = collect();
        $this->product = collect(); // Initialize $this->product
        $this->color = collect();
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

    public function viewColor()
    {
        if (!empty($this->color)) {
            $this->color = Color::where('product_id', $this->product_id)->get();
        }
    }

    public function resetinputfields()
    {
        $this->category_id = '';
        $this->subcategory_id = '';
        $this->product_id = '';
        $this->color_id = '';
        $this->image = '';
    }

    protected $rules = [
        'image' => 'required',
    ];

    protected $messages = [
        'image.required' => 'color Name is required',
    ];

        public function store()
        {
            $validatedData = $this->validate([
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'product_id' => 'required',
                'color_id' => 'required',
                'fields.*.image' => 'required|image', // limit to 1 MB
            ], [
                'category_id.required' => 'Select Category first.....',
                'subcategory_id.required' => 'Select Sub-Category first.....',
                'product_id.required' => 'Select Product first...',
                'color_id.required' => 'Color Name is required',
                'fields.*.image.required' => 'Image is required',
                'fields.*.image.image' => 'Only image files are allowed',
            ]);

            foreach ($validatedData['fields'] as $key => $value) {
                $image = $value['image'];

                if ($image) {
                    $imageName = substr(uniqid(), 0, 9);
                $imgpath = $image->getRealPath();
                $images = Cloudinary::upload($imgpath, [
                    'folder' => 'admin/color',
                    'public_id' => $imageName,
                ])->getSecurePath();

                    $data = new ProductImage;
                    $data->product_id = $validatedData['product_id'];
                    $data->color_id = $validatedData['color_id'];
                    $data->image = $images;
                    $data->save();
                }
            }

            $this->reset('category_id','subcategory_id','product_id','fields');
            session()->flash('success', 'Congratulations!! Color Added Successfully...');
            $this->emit('closemodal');
        }

        public function editColor($id)
    {
        $clr = ProductImage::find($id);
        if ($clr) {
            $this->pro_id = $clr->id;
            $this->image = $clr->image;

        } else {
            return redirect()->to('/admin/products');
        }

    }

    public function updateColor()
    {
        $validatedata = $this->validate();
        $data = ProductImage::find($this->pro_id);
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
        ProductImage::where('id', $this->pro_id)->update([
            'image' => $image,
        ]);
        $this->resetinputfields();
        session()->flash('success', 'Image Updated Successfully...');
        $this->emit('closemodal');
    }

    public function deleteColor($id)
    {
        $image = ProductImage::find($id);
        if ($image) {
            $this->colordelete_id = $image->id;

        } else {
            return redirect()->to('/admin/color');
        }
    }

    public function delete()
    {
        $clr = ProductImage::where('id', $this->colordelete_id)->first();
    
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
        $data = ProductImage::whereHas('product', function($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            })->orderByDesc('id')->paginate(10);
        return view('livewire.admin.color.image', compact('data'));
    }
}
