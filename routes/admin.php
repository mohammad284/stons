<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\Users\ListUsers;
use App\Http\Livewire\Admin\Appointment\ListAppointments;
use App\Http\Livewire\Admin\Appointment\CreateAppointmentForm;
use App\Http\Livewire\Admin\Profile\UpdateProfile;
use App\Http\Livewire\Admin\Worker\WorkerList;
use App\Http\Livewire\Admin\Worker\Activity;
use App\Http\Livewire\Admin\Category\CategoryList;
use App\Http\Livewire\Admin\Category\SubjectList;
use App\Http\Livewire\Admin\SettingsUpdate;
use App\Http\Livewire\Admin\Store\StoreList;
use App\Http\Livewire\Admin\Partner\AllPartnerCrush;
use App\Http\Livewire\Admin\Partner\PartnerList;
use App\Http\Livewire\Admin\Partner\CrusherList;
use App\Http\Livewire\Admin\Partner\ClientList;
use App\Http\Livewire\Admin\Invoice\InvoiceList;
use App\Http\Livewire\Admin\Invoice\ClientInvoiceList;
use App\Http\Livewire\Admin\Invoice\CrusherInvoiceList;
use App\Http\Livewire\Admin\Payment\PaymentList;
use App\Http\Livewire\Admin\Payment\CrushPaymentList;
use App\Http\Livewire\Admin\Report\CrushReport;
use App\Http\Livewire\Admin\Report\LabInsideReport;
use App\Http\Livewire\Admin\Report\LabOutsideReport;
use App\Http\Livewire\Admin\Report\LabWorkerReport;
use App\Http\Livewire\Admin\Expense\ExpenseList;
use App\Http\Livewire\Admin\Operation\CrushOperation;
use App\Http\Livewire\Admin\Operation\LabOperation;
use App\Http\Livewire\Admin\Operation\LabSalesOperation;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvoiceController;




Route::get('dashboard',DashboardController::class)->name('dashboard');

Route::get('users',ListUsers::class)->name('users');
Route::get('appointment',ListAppointments::class)->name('appointment');
Route::get('appointment/create',CreateAppointmentForm::class)->name('appointment.create');

Route::get('profile',UpdateProfile::class)->name('profile');

Route::get('worker',WorkerList::class)->name('worker');

Route::get('allPartners',AllPartnerCrush::class)->name('allPartners');

Route::get('activities',Activity::class)->name('activities');

Route::get('store',StoreList::class)->name('store');

Route::get('setting',SettingsUpdate::class)->name('setting');

Route::get('partners/{partner}/invoice', InvoiceList::class)->name('partners.invoice');

Route::get('clients/{client}/invoice', ClientInvoiceList::class)->name('clients.invoice');

// crusher 
Route::get('crushers',CrusherList::class)->name('crushers');
Route::get('crushers/{crusher}/invoice', CrusherInvoiceList::class)->name('crushers.invoice');
Route::get('crushers/expense', ExpenseList::class)->name('expense');
Route::get('crushers/operations', CrushOperation::class)->name('crushers.operations');
Route::get('crushers/{user}/payment', CrushPaymentList::class)->name('crushers.payment');
Route::get('crushReport',CrushReport::class)->name('crushReport');


// lab 
Route::get('lab/clients',ClientList::class)->name('lab.clients');
Route::get('lab/partners',PartnerList::class)->name('lab.partners');
Route::get('lab/{user}/payment', PaymentList::class)->name('lab.payment');
Route::get('lab/subjects',SubjectList::class)->name('lab.subjects');
Route::get('labInsideReport',LabInsideReport::class)->name('labInsideReport');
Route::get('labOutsideReport',LabOutsideReport::class)->name('labOutsideReport');
Route::get('labWorkerReport',LabWorkerReport::class)->name('labWorkerReport');
Route::get('lab/category',CategoryList::class)->name('lab.category');
Route::get('lab/{user}/payment', PaymentList::class)->name('lab.payment');
Route::get('lab/purchases', LabOperation::class)->name('lab.purchases');
Route::get('lab/salesOperations', LabSalesOperation::class)->name('lab.salesOperations');
