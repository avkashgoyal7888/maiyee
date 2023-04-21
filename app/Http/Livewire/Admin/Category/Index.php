<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\WithPagination;
use Livewire\Component;
use App\Models\Category;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search;
    public $cat_name, $startDate, $cat_id;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function closemodal()
    {
        $this->resetinputfields();
    }

    protected $rules = [
        'cat_name' => 'required',
    ];
    protected $messages = [
        'cat_name.required' => 'Category is required.....',
    ];

    public function resetinputfields()
    {
        $this->cat_name = '';
        $this->cat_id = '';

    }

    public function store()
    {
        $validatedata = $this->validate();

        $cat = new Category;

        $cat->cat_name = $this->cat_name;

        $cat->save();

        $this->resetinputfields();
        session()->flash('success', 'Category Added Successfully...');
        $this->emit('closemodal');
    }

    public function editCategory($id)
    {
        $cat = Category::find($id);
        if ($cat) {
            $this->cat_id = $cat->id;
            $this->cat_name = $cat->cat_name;

        } else {
            return redirect()->to('/admin/category');
        }

    }

    public function update()
    {
        $validatedata = $this->validate();
        Category::Where('id', $this->cat_id)->update([
            'cat_name' => $this->cat_name,
        ]);

        $this->resetinputfields();
        session()->flash('success', 'Category Updated Successfully...');
        $this->emit('closemodal');

    }

    public function deleteCategory($id)
    {
        $cat = Category::find($id);
        if ($cat) {
            $this->cat_id = $cat->id;

        } else {
            return redirect()->to('/admin/category');
        }
    }

    public function delete()
    {
        Category::Where('id', $this->cat_id)->delete();
        $this->resetinputfields();
        session()->flash('success', 'Category Deleted Successfully...');
        $this->emit('closemodal');

    }

    public function render()
    {
        $data = Category::where('cat_name', 'like', '%'.$this->search.'%')
                        ->orderByDesc('id')->paginate(10);
        return view('livewire.admin.category.index', ['data'=>$data]);
    }
}
