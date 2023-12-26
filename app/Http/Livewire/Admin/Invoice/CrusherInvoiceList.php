<?php

namespace App\Http\Livewire\Admin\Invoice;
use App\Models\CrusherInvoice;
use App\Models\Partner;
use App\Models\Payment;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class CrusherInvoiceList extends Component
{
    public $crusher;
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
			'note'   => 'required',
			'price'  => 'required',
			'subject'=> 'required',
			'wight'  => 'required',
			'driver' => 'required',
			'date'   => 'required',
		])->validate();
        $this->state['partner_id'] = $this->state['id'];
        $this->state['total_price'] = $this->state['price'] * $this->state['wight'] ; // stone
		CrusherInvoice::create($this->state);

        $data = [
            'date'       => $this->state['date'] ,
            'partner_id' => $this->state['id'],
            'statment'   => $this->state['required'],
            'required'   => $this->state['total_price'] ,
        ];
        CrushPayment::create($data);

        $this->state = [];

		$this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
	}

	public function mount(Partner $crusher)
	{
		$this->state = $crusher->toArray();

		$this->crusher = $crusher;
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
        $subjects = Subject::all();
        $crusher = $this->crusher;
        $invoices = CrusherInvoice::with('subject','partner')->where('partner_id',$crusher->id)->get();
        return view('livewire.admin.invoice.crusher-invoice-list',[
            'invoices' => $invoices,
            'crusher'  => $crusher,
            'subjects' => $subjects
        ]);
    }
}
