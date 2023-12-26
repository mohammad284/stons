<?php

namespace App\Http\Livewire\Admin\Invoice;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Partner;
use App\Models\Payment;
use App\Models\Store;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
class ClientInvoiceList extends Component
{
    public $cat = null;
    public $price = null;
    public $total_price = null;
    public $client;
    public $state = [];
    public $showEditModal = false ;
    public $invoiceIdBeingRemoved = null ;
    public $selectedValue = null;
    public $calTotal = null;

    public function addNew()
    {
        $state = [];
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createInvoice()
	{
        
        $validatedData = Validator::make($this->state, [
			'subject_id' => 'required',
			'count'   => 'required',
			'date'   => 'required',
			'statment'   => 'required',
			'price'   => 'sometimes',
		])->validate();

        if(empty($this->state['price'])) {
			$this->state['price'] = $this->cat['price'];
		}else{
            $this->state['price'] =  $this->state['price'];
        }

        if(empty($this->state['total_price'])) {
			$this->state['total_price'] = $this->total_price;
		}else{
            $this->state['total_price'] =  $this->state['total_price'];
        }
        $this->state['partner_id'] = $this->state['id'];
        $this->state['state'] = 'out';

		Invoice::create($this->state);

        $data = [
            'date'       => $this->state['date'] ,
            'partner_id' => $this->state['id'],
            'statment'   => $this->state['statment'],
            'required'   => $this->state['total_price'] ,
            'state'      => 'out' ,
        ];
        Payment::create($data);

        $category = Store::where('category_id',$this->state['subject_id'])->first() ;
        // dd($category);
        $this->state['count'] = $category->count - $this->state['count'];
        $category->update($this->state);

        $this->state = [];
		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}

    public function updatedSelectedValue($value_id)
    {
        $this->cat = Category::find($value_id);
        $this->price = $this->cat['price'];
    }
    public function updatedCalTotal($value_id)
    {
        $count = $value_id;
        $this->total_price = $this->price * $count;
    }
	public function mount(Partner $client)
	{
		$this->state = $client->toArray();

		$this->client = $client;
        $this->selectedValue = Category::find($this->selectedValue);
	}
    public function confirmUserRemove($invoiceId)
    {
        $this->invoiceIdBeingRemoved = $invoiceId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteInvoice()
    {
        $invoice = CrusherInvoice::findOrFail($this->invoiceIdBeingRemoved);
        $invoice->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }

    public function render()
    {
        $categories = Category::where('state','product')->get();
        $client = $this->client;
        $invoices = Invoice::with('category','partner')->where('partner_id',$client->id)->get();
        return view('livewire.admin.invoice.client-invoice-list',[
            'invoices' => $invoices,
            'client'  => $client,
            'categories' => $categories
        ]);
    }
}
