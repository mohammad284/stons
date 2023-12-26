<?php

namespace App\Http\Livewire\Admin\Appointment;

use App\Http\Livewire\Admin\AdminComponent;
use App\Models\Appointment;
class ListAppointments extends AdminComponent
{
    public $status = null;
    protected $queryString = ['status'];
    public $selectedRows = [];
    public $selectPageRows = false;

    public function filterAppointmentsByStatus($status = null){
        $this->status = $status;
    }
    public function updatedSelectPageRows($value){
        if($value){
            $this->selectedRows = $this->appointments->pluck('id')->map(function ($id){
                return (string) $id;
            }); 
        }else{
            $this->reset(['selectedRows','selectPageRows']);
        }
    }
    public function deleteSelectedRows(){
        Appointment::whereIn('id',$this->selectedRows)->delete();
        $this->reset(['selectedRows','selectPageRows']);
    }
    public function markAllAsScheduled(){
        Appointment::whereIn('id',$this->selectedRows)->update(['status'=>'SCHEDULED']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }
    public function markAllAsClose(){
        Appointment::whereIn('id',$this->selectedRows)->update(['status'=>'CLOSED']);
        $this->reset(['selectPageRows', 'selectedRows']);
    }
    public function getAppointmentsProperty(){
        return Appointment::with('client')
        ->when($this->status,function($query,$status){
            return $query->where('status',$status);
        })
        ->latest()->paginate(5);
    }
    public function render()
    {
        $appointments = $this->appointments;

        $appointmentCount = Appointment::count();
        $scheduledAppointmentCount = Appointment::where('status','SCHEDULED')->count();
        $closedAppointmentCount = Appointment::where('status','CLOSED')->count();
        return view('livewire.admin.appointment.list-appointments',[
            'appointments' => $appointments,
            'scheduledAppointmentCount'=>$scheduledAppointmentCount,
            'closedAppointmentCount' => $closedAppointmentCount,
            'appointmentCount' => $appointmentCount
        ]);
    }
}
