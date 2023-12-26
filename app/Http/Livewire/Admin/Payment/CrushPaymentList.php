<?php

namespace App\Http\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\CrushPayment;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;

class CrushPaymentList extends Component
{
    public $user;
    public $state = [];
    public $showEditModal = false ;
    public $paymentIdBeingRemoved = null ;

    public function addNew()
    {
        $state = [];
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createPayment()
	{
		$validatedData = Validator::make($this->state, [
			'required'   => 'sometimes',
			'payments'  => 'sometimes',
			'date'  => 'required',
			'statment'  => 'required',
			'received_id'  => 'required',
		])->validate();

        $this->state['state'] = 'in';
        $this->state['partner_id'] = $this->state['id'];
		CrushPayment::create($this->state);
        $this->state = [];
		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}

    public function mount(Partner $user)
	{
		$this->state = $user->toArray();

		$this->user = $user;
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
        $user = $this->user;
        $payments = CrushPayment::with('partner','received')->where('partner_id',$user->id)->where('state','in')->get();
        $partners = Partner::where('status','partner')->get();
        return view('livewire.admin.payment.crush-payment-list',[
            'user' => $user,
            'payments' => $payments,
            'partners' => $partners
        ]);
    }
}
