<?php

namespace App\Http\Livewire\Admin\Payment;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;
class PaymentList extends Component
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
			'payments'   => 'required',
			'date'   => 'required',
			'statment'  => 'required',
		])->validate();
        $this->state['partner_id'] = $this->state['id'];
        $partner = Partner::find($this->state['partner_id']);
        if($partner->status == 'stone_client'){
            $this->state['state'] = 'out';
        }else{
            $this->state['state'] = 'in';
        }
        
		Payment::create($this->state);
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
        $payment = Payment::findOrFail($this->paymentIdBeingRemoved);
        $payment->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }
    public function render()
    {
        $user = $this->user;
        $payments = Payment::where('partner_id',$user->id)->get();
        return view('livewire.admin.payment.payment-list',[
            'user' => $user,
            'payments' => $payments
        ]);
    }
}
