<?php

namespace App\Http\Livewire\Admin\Worker;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Worker;
use App\Models\Category;
use App\Models\Store;
use App\Models\ActivityWorker;
use Illuminate\Support\Facades\Validator;

class Activity extends AdminComponent
{
    public $cat = null;
    public $price = null;
    public $total_price = null;
    public $showEditModal = false ;
    public $state = [];
    public $data = [];
    public $selectedValue = null;
    public $calTotal = null;
    public $status = [];

    public function addNew()
    {
        $this->reset();
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function filterSubjectByStatus($status = null)
    {
        // dd($status);
        $this->status = $status;
    }

    public function updatedSelectedValue($value_id)
    {
        $this->cat = Category::find($value_id);
        $this->price = $this->cat['worker_wages'];
    }
    
    public function updatedCalTotal($value_id)
    {
        $count = $value_id;
        $this->total_price = $this->price * $count;
    }
	public function mount()
	{
        $this->selectedValue = Category::find($this->selectedValue);
	}
        public function createActive()
	{
        $validatedData = Validator::make($this->state, [
			'worker_id' => 'required',
			'category_id' => 'required',
			'count'   => 'required',
			'date'   => 'required',
			'price'   => 'sometimes',
			'total_price'   => 'sometimes',
		])->validate();

        if(empty($this->state['price'])) {
			$this->state['price'] = $this->cat['worker_wages'];
		}else{
            $this->state['price'] =  $this->state['price'];
        }

        if(empty($this->state['total_price'])) {
			$this->state['total_price'] = $this->total_price;
		}else{
            $this->state['total_price'] =  $this->state['total_price'];
        }
		ActivityWorker::create($this->state);

        $category = Store::where('category_id',$this->state['category_id'])->first() ;
        if($category == null){
            Store::create($this->state);
        }else{
            $this->state['count'] += $category->count;
            $category->update($this->state);
        }

        $this->state = [];

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}
    public function apply(){
        $this->data = $this->state;
        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
    }
    public function getActivitiesProperty(){

        return ActivityWorker::when($this->data,function($query,$data){
            return $query->where('worker_id',$data['worker'])->whereBetween('date',[$data['from'],$data['to']]);
        })
        ->when($this->status,function($query,$status){
            return $query->where('worker_id',$status);
        })
        ->latest()->paginate(30);
       
    }
    public function render()
    {
        $activities = $this->activities;
        $categories = Category::where('state','product')->get();
        $workers = Worker::all();
        if($this->status == null){
            $totals = ActivityWorker::sum('total_price');
            $counts = ActivityWorker::sum('count');
        }else{
            $totals = ActivityWorker::where('worker_id',$this->status)->sum('total_price');
            $counts = ActivityWorker::where('worker_id',$this->status)->sum('count');
        }
        return view('livewire.admin.worker.activity',[
            'activities' => $activities,
            'workers'=> $workers,
            'categories' => $categories,
            'totals' => $totals,
            'counts' => $counts,
        ]);
    }
}
