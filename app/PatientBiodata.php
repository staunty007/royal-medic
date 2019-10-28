<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Patient;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PatientBiodata extends Model
{
    protected $fillable = ['patient_id','p_code','mobile2','blood_group','address','dob','status',];

    protected $casts = [
        'dob' => 'date',
    ];

    

    // public function setDobAttribute($value)
    // {
    //     #$this->attributes['dob'] = Carbon::parse($value)->format('Y-m-d');
    //     $this->attributes['dob'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    // }

    public function getDobAttribute($value)
    {
        return Carbon::parse($value)->format('Y/m/d');
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function findByPCode($pcode, $type = null)
    {
        $foundPatient = $this->where('p_code',$pcode)->with('patient')->first();
        if ($foundPatient) {
            if ($type == 'name') {
                return  $foundPatient->patient->name;
            } else {
                return $foundPatient->patient->id;
            }
        } else {
            throw new ModelNotFoundException("No Patient Found", 1);
        }
    }
}
