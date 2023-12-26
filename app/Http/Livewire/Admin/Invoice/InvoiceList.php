<?php

namespace App\Http\Livewire\Admin\Invoice;

use Livewire\Component;
use App\Models\Invoice;
use App\Models\Partner;
use App\Models\Payment;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class InvoiceList extends Component
{
    public $partner;
    public $state = [];
    public $showEditModal = false ;
    public $invoiceIdBeingRemoved = null ;


    public function addNew()
    {
        $state = [];
        $this->showEditModal = false ;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createInvoice()
	{
		$validatedData = Validator::make($this->state, [
			'price'  => 'required',
			'subject_id' => 'required',
			'count'  => 'required',
			'date'   => 'required',
			'statment'   => 'required',
		])->validate();
        $this->state['partner_id'] = $this->state['id'];
        $this->state['total_price'] = $this->state['price'] * $this->state['count'] ; // stone
        $this->state['state'] = 'in'; // فاتورة موردين داخل للمعمل 
		Invoice::create($this->state);

        $data = [
            'partner_id' =>  $this->state['partner_id'],// من مين مشتري بضاعة 
            'date'     => $this->state['date'],
            'statment' => $this->state['statment'],
            'required' => $this->state['total_price'],// شو مطلوب مني 
            'state'    => 'in',
        ];
        Payment::create($data);
        $this->state = [];
		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}
	public function mount(Partner $partner)
	{
		$this->state = $partner->toArray();

		$this->partner = $partner;
	}
    
    public function confirmUserRemove($invoiceId)
    {
        $this->invoiceIdBeingRemoved = $invoiceId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteInvoice()
    {
        $invoice = Invoice::findOrFail($this->invoiceIdBeingRemoved);
        $invoice->delete();
        $this->dispatchBrowserEvent('hide-delete-model', ['message' => 'User deleted successfully!']);
    }

    public function render()
    {
        $subjects = Category::where('state','raw')->get();
        $partner = $this->partner;
        $invoices = Invoice::with('category')->where('partner_id',$partner->id)->get();
        return view('livewire.admin.invoice.invoice-list',[
            'invoices' => $invoices,
            'partner'  => $partner,
            'subjects' => $subjects
        ]);
    }
}
