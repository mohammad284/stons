<?php

namespace App\Http\Livewire\Admin\Expense;

use Livewire\Component;
use App\Models\CrushPayment;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;

class ExpenseList extends Component
{
    public $state = [];
    public $showEditModal = false ;
    public $paymentIdBeingRemoved = null ;
    public $expense;

    public function addNew()
    {
        $state = [];
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createExpense()
	{
		$validatedData = Validator::make($this->state, [
			'payments'  => 'required',
			'date'     => 'required',
			'statment'  => 'required',
            'partner_id' => 'required',
		])->validate();
        $this->state['state'] = 'out';
		CrushPayment::create($this->state);
        $this->state = [];
		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}

    public function edit(CrushPayment $expense)
    {
        $this->reset();
        $this->showEditModal = true;
        $this->expense = $expense;
        $this->state = $expense->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateExpense(){
		$validatedData = Validator::make($this->state, [
			'payment'  => 'required',
			'date'     => 'required',
			'statment'  => 'required',
		])->validate();

		$this->expense->update($validatedData);

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }
    public function confirmUserRemove($paymentId)
    {
        $this->paymentIdBeingRemoved = $paymentId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deletePayment()
    {
        $payment = CrushPayment::findOrFail($this->paymentIdBeingRemoved);
        $payment->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }
    public function render()
    {
        $partners = Partner::where('status','partner')->get();
        $expenses = CrushPayment::with('partner')->where('state','out')->get();
        return view('livewire.admin.expense.expense-list',[
            'expenses' => $expenses,
            'partners' => $partners
        ]);
    }
}
