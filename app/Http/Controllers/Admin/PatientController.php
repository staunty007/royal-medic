<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Patient;
use App\PatientBiodata;
use Illuminate\Support\Facades\Validator;

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
            "blood_group" => $request->biodata['blood_group'],
            "dob" => $request->biodata['dob'],
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

        $newUser->fill([
            'name' => $request->fname ." ". $request->lname,
            'mobile' => $request->mobile,
            'gender' => $request->gender,
            'status' => $request->status,
        ])->save();

        #return $newUser;
        
        $newUser->biodata()->update([
            "blood_group" => $request->biodata['blood_group'],
            "dob" => $request->biodata['dob'],
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
}
