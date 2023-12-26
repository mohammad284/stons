<?php

namespace App\Http\Livewire\Admin\Operation;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;

class LabOperation extends Component
{
    public $status = null;
    public $state = [];
    public $showEditModal = false ;
    public $paymentIdBeingRemoved = null ;


    public function getOperationsProperty()
    {
        return Payment::with('partner')
        ->when($this->status,function($query,$status){
            return $query->where('state',$status);
        })
        ->when($this->state,function($query,$state){
            return $query->where('partner_id',$state);
        })
        ->where('state','in')
        ->paginate(30);
    }

    public function getRequiredInProperty (){
        $required_in = Payment::where('state','in')
        ->when($this->state,function($query,$state){
            return $query->where('received_id',$state);
        })
        ->sum('required');
        return $required_in;
    }

    public function getPaymentsInProperty (){
        $payments_in = Payment::where('state','in')
        ->when($this->state,function($query,$state){
            return $query->where('partner_id',$state);
        })
        ->sum('payments');
        return $payments_in;
    }

    public function render()
    {
        $operations = $this->operations;
        $required_in = $this->required_in;
        $payments_in = $this->payments_in;

        return view('livewire.admin.operation.lab-operation',[
            'operations' => $operations,
            'required_in'=> $required_in,
            'payments_in' => $payments_in,
        ]);
    }
}
