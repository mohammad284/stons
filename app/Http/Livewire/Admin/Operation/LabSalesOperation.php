<?php

namespace App\Http\Livewire\Admin\Operation;

use Livewire\Component;
use App\Models\Payment;
use App\Models\Partner;
use Illuminate\Support\Facades\Validator;
class LabSalesOperation extends Component
{

    public $status = null;
    public $state = [];
    public $showEditModal = false ;
    public $paymentIdBeingRemoved = null ;


    public function getOperationsProperty()
    {
        $operations = Payment::with('partner')
        ->when($this->status,function($query,$status){
            return $query->where('state',$status);
        })
        ->when($this->state,function($query,$state){
            return $query->where('partner_id',$state);
        })
        ->where('state','out')
        ->paginate(30);
        return $operations;
    }

    public function getRequiredOutProperty (){
        $required_out = Payment::where('state','out')
        ->when($this->state,function($query,$state){
            return $query->where('received_id',$state);
        })
        ->sum('required');
        return $required_out;
    }

    public function getPaymentsOutProperty (){
        $payments_out = Payment::where('state','out')
        ->when($this->state,function($query,$state){
            return $query->where('partner_id',$state);
        })
        ->sum('payments');
        return $payments_out;
    }


    public function render()
    {
        $operations = $this->operations;
        $required_out = $this->required_out;
        $payments_out = $this->payments_out;

        return view('livewire.admin.operation.lab-sales-operation',[
            'operations' => $operations,
            'required_out' => $required_out,
            'payments_out' => $payments_out
        ]);
    }
}
