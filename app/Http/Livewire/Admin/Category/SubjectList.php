<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
class SubjectList extends Component
{
    public $showEditModal = false ;
    public $state = [];
    public $subject ;
    public $subjectIdBeingRemoved = null ;

    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createSubject()
	{
		$validatedData = Validator::make($this->state, [
			'name'   => 'required',
		])->validate();

		Category::create($validatedData);

		session()->flash('message', 'User added successfully!');

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}

    public function edit(Category $subject)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->subject = $subject;
        $this->state = $subject->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateSubject()
    {
		$validatedData = Validator::make($this->state, [
			'name'   => 'required',
		])->validate();

		$this->subject->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }

    public function confirmSubjectRemove($subjectId)
    {
        $this->subjectIdBeingRemoved = $subjectId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteSubject()
    {
        $subject = Category::findOrFail($this->subjectIdBeingRemoved);
        $subject->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }

    public function render()
    {
        $subjects = Category::where('state','raw')->get();
        return view('livewire.admin.category.subject-list',[
            'subjects' => $subjects
        ]);
    }
}
