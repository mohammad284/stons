<?php

namespace App\Http\Livewire\Admin\Operation;

use Livewire\Component;
use App\Models\Partner;
use App\Models\CrushPayment;

class CrushOperation extends Component
{

    public $status = null;
    public $state = [];
    public $showEditModal = false ;
    public $paymentIdBeingRemoved = null ;

    public function filterAppointmentsByStatus($status = null){
        $this->status = $status;
    }
    public function filterPartnerByStatus($state = null){
        $this->state = $state;
    }
    
    public function getOperationsProperty()
    {
        return CrushPayment::with('partner','received')
        ->when($this->status,function($query,$status){
            return $query->where('state',$status);
        })
        ->when($this->state,function($query,$state){
            return $query->where('partner_id',$state)->orwhere('received_id',$state);
        })
        ->latest()->paginate(30);
    }
    public function getTotalInProperty (){
        $total_in = CrushPayment::where('state','in')
        ->when($this->state,function($query,$state){
            return $query->where('received_id',$state);
        })
        ->sum('payments');
        return $total_in;
    }
    public function getTotalOutProperty (){
        $total_out = CrushPayment::where('state','out')
        ->when($this->state,function($query,$state){
            return $query->where('partner_id',$state);
        })
        ->sum('payments');
        return $total_out;
    }
    public function render()
    {
        $operations = $this->operations;
        $total_in = $this->total_in;
        $total_out = $this->total_out;
        
        $partners = Partner::where('status','partner')->get();
        return view('livewire.admin.operation.crush-operation',[
            'operations' => $operations,
            'ins' => $total_in,
            'outs' => $total_out,
            'partners'=> $partners
        ]);
    }
}
