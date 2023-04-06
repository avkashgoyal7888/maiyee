<?php

namespace App\Http\Livewire\Admin\Subcategory;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\SubCategory;
use App\Models\Category;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $sub_name, $cat_id, $catid, $startDate, $endDate;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->category = Category::all();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'cat_id' => 'required',
        'sub_name' => 'required',
    ];
    protected $messages = [
        'cat_id.required' => 'Category is required',
        'sub_name.required' => 'Sub-Category is required.....',
    ];

    public function resetinputfields()
    {
        $this->sub_name = '';
        $this->cat_id = '';
    }

    public function store()
    {
        $validatedata = $this->validate();

        $sub_cat = new SubCategory;

        $sub_cat->cat_id = $this->cat_id;
        $sub_cat->sub_name = $this->sub_name;

        $sub_cat->save();

        $this->resetinputfields();
        session()->flash('success', 'Sub-Category Added Successfully...');
        $this->emit('closemodal');
    }

    public function editCategory($id)
    {
        $sub_cat = SubCategory::find($id);
        if ($sub_cat) {
            $this->sub_id = $sub_cat->id;
            $this->cat_id = $sub_cat->cat_id;
            $this->sub_name = $sub_cat->sub_name;

        } else {
            return redirect()->to('/admin/sub-category');
        }

    }

    public function update()
    {
        $validatedata = $this->validate();
        SubCategory::Where('id', $this->sub_id)->update([
            'cat_id' => $this->cat_id,
            'sub_name' => $this->sub_name,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'Sub-Category Updated Successfully...');
        $this->emit('closemodal');

    }

    public function delete($id)
    {
        SubCategory::Where('id', $id)->delete();
        session()->flash('success', 'Sub-Category Deleted Successfully...');
        $this->emit('closemodal');

    }

    public function render()
    {
        $data = SubCategory::where('sub_name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.subcategory.index', ['data'=>$data]);
    }
}
