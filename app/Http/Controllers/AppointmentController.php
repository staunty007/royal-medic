<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Appointment;
use App\PatientBiodata;
use App\Patient;
use Illuminate\Support\Str;

class AppointmentController extends Controller
{
    public function store(Request $request, PatientBiodata $patient)
    {
        #return $request->all();        
        $patient_id = $patient->findByPCode($request->p_code);
        $appointment = Appointment::create([
            'patient_id' => $patient_id,
            'department' => $request->department,
            'doctor_id' => $request->doctor_id,
            'date' => $this->fullDateModify($request->date),
            'problem' => $request->problem,
            'slot' => rand(00000,99999),
            'status' => $request->status
        ]);

        return $this->successWithData('Appointment Added Successfully');
    }

    public function fetch()
    {
        $appointment = Appointment::with(['patient:id,name,mobile','doctor:id,name,mobile'])->get();

        return $this->successWithData($appointment);
    }
}
