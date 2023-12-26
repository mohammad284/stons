<?php

namespace App\Http\Livewire\Admin\Partner;

use Livewire\Component;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;
class CrusherList extends Component
{
    public $showEditModal = false ;
    public $state = [];
    public $crucsher;
    public $userIdBeingRemoved = null;
    
    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createCrusher()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'mobile' => 'required',
		])->validate();
        $this->state['status'] = 'crush'; // stone

		Partner::create($this->state);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}

    public function edit(Partner $crucsher)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->crucsher = $crucsher;
        $this->state = $crucsher->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateCrusher(){
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'mobile' => 'required',
		])->validate();
        $this->state['status'] = 'crush'; // stone

		$this->crucsher->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }

    public function confirmUserRemove($userId)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function deleteCrusher()
    {
        $crucsher = Partner::findOrFail($this->userIdBeingRemoved);
        $crucsher->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }

    public function render()
    {
        $crushers = Partner::where('status','crush')->latest()->paginate(5);
        return view('livewire.admin.partner.crusher-list',[
            'crushers' => $crushers
        ]);
    }
}
