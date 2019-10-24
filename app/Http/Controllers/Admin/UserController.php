<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class UserController extends Controller
{
    public function store(Request $request, User $user)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email:rfc,dns|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validate->fails()) {
            return $this->errorWithData($validate->errors());
        }
        $user->create([
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'status' => $request->status
        ]);
        return $this->successWithData('User Created Successfully', 201);
    }

    public function update(Request $request, User $user, $id)
    {
        $newUser = $user->findOrFail($id);

        $newUser->fill([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'type' => $request->type,
            'status' => $request->status,
        ])->save();
        
        $allUsers = User::all();

        return $this->successWithData(['User Updated Successfully', $allUsers], 200);

        
    }

    public function fetch()
    {
        $users =  User::all();
        return $this->successWithData($users, 200);
    }
}
