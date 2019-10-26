<?php

namespace App\Http\Controllers\Admin;

use App\Department;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Doctor;
use App\User;

class DoctorController extends Controller
{
    public function store(Request $request, User $user)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255|unique:users',
            'type' => 'required|string|max:255',
        ]);

        if ($validate->fails()) {
            return $this->errorWithData($validate->errors());
        }
        
        $newUser = $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make('password'),
            'type' => $request->type,
            'status' => $request->status
        ]);

        Department::create([
            'name' => $request->type, 
            'doctor_id' => $newUser->id,
            'status' => $request->status
        ]);

        return $this->successWithData('Doctor Created Successfully', 201);
    }

    public function update(Request $request, Doctor $doctor, $id)
    {
        $newUser = $doctor->findOrFail($id);

        $newUser->fill([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'status' => $request->status,
        ])->save();
        
        $newUser->dept()->update([
            'name' =>  $request->type
        ]);

        return $this->successWithData('Doctor Updated Successfully', 200);

        
    }

    public function fetch()
    {
        $users = Doctor::with('dept')->get();
        return $this->successWithData($users, 200);
    }

}
