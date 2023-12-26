<?php

namespace App\Http\Livewire\Admin\Category;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class CategoryList extends AdminComponent
{
    public $showEditModal = false ;
    public $state = [];
    public $category ;
    public $categoryIdBeingRemoved = null ;

    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createCategory()
	{
		$validatedData = Validator::make($this->state, [
			'name'   => 'required',
			'price'  => 'required',
			'worker_wages' => 'required',
		])->validate();
        $this->state['state'] = 'product';
		$cat =  Category::create($validatedData);

        $data = [
            'category_id' => $cat->id,
            'count' => 0
        ];
        Store::create($data);
		session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}
    
    public function edit(Category $category)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->category = $category;
        $this->state = $category->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateCategory(){
		$validatedData = Validator::make($this->state, [
			'name'   => 'required',
			'price'  => 'required',
			'worker_wages' => 'required',
		])->validate();

		$this->category->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }

    public function confirmUserRemove($categoryId)
    {
        $this->categoryIdBeingRemoved = $categoryId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $category = Category::findOrFail($this->categoryIdBeingRemoved);
        $category->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }

    public function render()
    {
        $categories = Category::where('state','product')->get();
        return view('livewire.admin.category.category-list',[
            'categories' => $categories
        ]);
    }
}
