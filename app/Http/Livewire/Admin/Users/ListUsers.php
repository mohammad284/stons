<?php

namespace App\Http\Livewire\Admin\Users;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\User;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
class ListUsers extends AdminComponent
{
    use WithFileUploads;
    public $state = [];
    public $showEditModal = false ;
    public $userIdBeingRemoved = null;
    public $user;
    public $photo;

    public function changeRole(User $user , $role){
        Validator::make(['role' => $role], [
			'role' => [
				'required',
				Rule::in(User::ROLE_ADMIN, User::ROLE_USER),
			],
		])->validate();
        $user->update(['role'=>$role]);
    }
    public function addNew(){
        $this->reset();
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }
	public function createUser()
	{
		$validatedData = Validator::make($this->state, [
			'name' => 'required',
			'email' => 'required|email|unique:users',
			'password' => 'required|confirmed',
		])->validate();

		$validatedData['password'] = bcrypt($validatedData['password']);
        
		if ($this->photo) {
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		User::create($validatedData);

		// session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}
    public function edit(User $user){
        $this->reset();
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }
    public function updateUser(){
        $validatedData = Validator::make($this->state, [
			'name' => 'required',
			'email' => 'required|email|unique:users,email,'.$this->user->id,
			'password' => 'sometimes|confirmed',
		])->validate();

		if(!empty($validatedData['password'])) {
			$validatedData['password'] = bcrypt($validatedData['password']);
		}

		if ($this->photo) {
			Storage::disk('avatars')->delete($this->user->avatar);
			$validatedData['avatar'] = $this->photo->store('/', 'avatars');
		}

		$this->user->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }
    public function confirmUserRemove($userId){
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }
    public function deleteUser(){
        $user = User::findOrFail($this->userIdBeingRemoved);
        $user->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }
    public function render()
    {
        $users = User::latest()->paginate(5);
        return view('livewire.admin.users.list-users',[
            'users' => $users,
        ]);
    }
}
