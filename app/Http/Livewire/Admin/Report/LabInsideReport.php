<?php

namespace App\Http\Livewire\Admin\Report;

use Livewire\Component;
use App\Models\Invoice;
use Illuminate\Support\Facades\Validator;
class LabInsideReport extends Component
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

    public function getReportsProperty()
    {
        return Invoice::when($this->state,function($query,$state){
            return $query->wherebetween('date',[$state['from'],$state['to']]);
        })
        ->when($this->status,function($query,$status){
            return $query->where('subject',$status);
        })
        ->get();
    }

    public function render()
    {
        $reports = $this->reports;
        dd($reports);
        return view('livewire.admin.report.lab-inside-report');
    }
}
