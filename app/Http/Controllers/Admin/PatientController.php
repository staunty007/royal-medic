<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\PatientBiodata;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PatientController extends Controller
{
    public function store(Request $request, User $user)
    {
        $validate = Validator::make($request->all(), [
            'fname' => 'required|string|max:255',
            'lname' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255|unique:users',
        ]);

        if ($validate->fails()) {
            return $this->errorWithData($validate->errors());
        }

        #return response()->json($request->all());
        $newUser = User::create([
            'name' => $request->fname . " ". $request->lname,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'password' => \Hash::make('password'),
            'status' => $request->status
        ]);

        PatientBiodata::create([
            'patient_id' => $newUser->id,
            'p_code' => rand(0000000,9999999),
            "blood_group" => $request->biodata['blood_group'],
            "dob" => $this->modifyDate($request->biodata['dob']),
            'address' => $request->biodata['address'],
            'mobile2' => $request->biodata['mobile2'],
            'status' => $newUser->status,
        ]);

        return $this->successWithData('Doctor Added Successfully', 201);
    }

    public function update(Request $request, Patient $patient, $id)
    {
        $newUser = $patient->findOrFail($id);

        #return $newUser->with('biodata')->first();
        $a = $request->biodata['dob'];
        $b = Carbon::createFromFormat('d/m/Y', $request->biodata['dob'])->format('Y-m-d');
        #return [$a, $b];

        $newUser->fill([
            'name' => $request->fname ." ". $request->lname,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'status' => $request->status,
        ])->save();

        #return $newUser;
        
        $newUser->biodata()->update([
            "blood_group" => $request->biodata['blood_group'],
            "dob" => $this->modifyDate($request->biodata['dob']),
            'address' => $request->biodata['address'],
            'mobile2' => $request->biodata['mobile2'],
            'status' => $newUser->status,
        ]);
        

        return $this->successWithData('Patient Updated Successfully', 200);
    }

    public function fetch()
    {
        $users = Patient::with('biodata')->get();
        return $this->successWithData($users, 200);
    }

    public function findPatient($p_code, PatientBiodata $patient)
    {
        return $patient->findByPCode($p_code, "name");

    }
}
