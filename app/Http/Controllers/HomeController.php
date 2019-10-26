<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Doctor;
use App\Patient;
use App\PatientBiodata;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $newUser = Patient::create([
        //     'name' => 'Jones Walter',
        //     'email' => 'jones@yahoo.io',
        //     'mobile' => '09082366233',
        //     'password' => \Hash::make('password'),
        //     'type' => "",
        //     'status' => 1
        // ]);

        // PatientBiodata::create([
        //     'patient_id' => $newUser->id,
        //     "blood_group" => 'AB',
        //     'status' => 1
        // ]);

        #return Doctor::all();
        #return Patient::with('biodata')->get();
        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'doctor']);
        // Role::create(['name' => 'nurse']);
        // Role::create(['name' => 'patient']);
        #$permission = Permission::create(['name' => 'write post']);
        // $permission = Permission::findById(1);
        // $role = Role::findById(1);
        // $role->givePermissionTo($permission);
        #auth()->user()->revokePermissionTo('edit post');
        #auth()->user()->removeRole('writer');
        #return auth()->user()->getPermissionsViaRoles();
        #return User::permission('write post')->get();
        return view('home');
    }
}
