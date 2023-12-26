<?php

namespace App\Http\Livewire\Admin\Worker;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Worker;
use Illuminate\Support\Facades\Validator;

class WorkerList extends AdminComponent
{
    public $showEditModal = false ;
    public $state = [];
    public $worker ;
    public $workerIdBeingRemoved = null ;

    public function addNew(){
        $this->reset();
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser()
	{
		$validatedData = Validator::make($this->state, [
			'name'   => 'required',
			'mobile' => 'required',
		])->validate();

		Worker::create($validatedData);

		session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}
    public function edit(Worker $worker)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->worker = $worker;
        $this->state = $worker->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser(){
		$validatedData = Validator::make($this->state, [
			'name'   => 'required',
			'mobile' => 'required',
		])->validate();

		$this->worker->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }

    public function confirmUserRemove($workerId)
    {
        $this->workerIdBeingRemoved = $workerId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function deleteUser()
    {
        $worker = Worker::findOrFail($this->workerIdBeingRemoved);
        $worker->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }
    public function render()
    {
        $workers = Worker::latest()->paginate(5);
        return view('livewire.admin.worker.worker-list',[
            'workers' => $workers
        ]);
    }
}
