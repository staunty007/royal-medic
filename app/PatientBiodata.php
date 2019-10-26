<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientBiodata extends Model
{
    protected $fillable = ['patient_id','mobile2','blood_group','address','dob','status',];

    protected $casts = [
        'dob' => 'datetime',
    ];
}
