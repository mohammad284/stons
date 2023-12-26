<?php

namespace App\Http\Livewire\Admin\Report;

use Livewire\Component;
use App\Models\CrusherInvoice;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;
class CrushReport extends Component
{
    public $status = [];
    public $showEditModal = false ;
    public $state = [];
    public $category ;
    public $categoryIdBeingRemoved = null ;

    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function filterSubjectByStatus($status = null){
        $this->status = $status;
    }
    public function filterReports($state = null,$status = null)
    {
        $validatedData = Validator::make($this->state, [
			'from'   => 'required',
			'to'     => 'required',
			'subject'=> 'required',
		])->validate();
        if($this->state['subject'] != 1){
            $this->status = $this->state['subject'];
        }else{
            $this->status = null;
        }
        $this->state = $this->state;
        

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
    }

    public function getReportsProperty()
    {
        return CrusherInvoice::when($this->state,function($query,$state){
            return $query->wherebetween('date',[$state['from'],$state['to']]);
        })
        ->when($this->status,function($query,$status){
            return $query->where('subject',$status);
        })
        ->paginate(10);
    }

    public function render()
    {
        $reports = $this->reports;
        if($this->status == null){
            $total_wight = CrusherInvoice::sum('wight');
            $total_price = CrusherInvoice::sum('total_price');
        }else{
            $total_wight = CrusherInvoice::where('subject',$this->status)->sum('wight');
            $total_price = CrusherInvoice::where('subject',$this->status)->sum('total_price');
        }

        return view('livewire.admin.report.crush-report',[
            'reports'     => $reports,
            'total_wight' => $total_wight,
            'total_price' => $total_price
        ]);
    }
}
