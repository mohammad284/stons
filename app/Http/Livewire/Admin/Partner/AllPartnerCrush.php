<?php

namespace App\Http\Livewire\Admin\Partner;

use Livewire\Component;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;

class AllPartnerCrush extends Component
{
    public $showEditModal = false ;
    public $state = [];
    public $partner;
    public $userIdBeingRemoved = null;

    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createPartner()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'percentage' => 'required',
		])->validate();
        $this->state['status'] = 'partner'; // stone

		Partner::create($this->state);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}
    
    public function edit(Partner $partner)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->partner = $partner;
        $this->state = $partner->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updatePartner(){
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
            'percentage' => 'required',
		])->validate();

		$this->partner->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }

    public function confirmUserRemove($userId)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function deletePartner()
    {
        $partner = Partner::findOrFail($this->userIdBeingRemoved);
        $partner->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }

    public function render()
    {
        $partners = Partner::where('status','partner')->get();
        return view('livewire.admin.partner.all-partner-crush',[
            'partners' => $partners
        ]);
    }
}
