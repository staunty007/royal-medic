<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/find-patient/{p_code}', 'Admin\PatientController@findPatient');

Route::get('/appointment','AppointmentController@fetch');
Route::post('/appointment','AppointmentController@store');

Route::post('admin/doctor/create', 'Admin\DoctorController@store');
Route::get('admin/doctors', 'Admin\DoctorController@fetch');
Route::post('admin/doctor/{id}/update', 'Admin\DoctorController@update');

Route::post('admin/patient/create', 'Admin\PatientController@store');
Route::get('admin/patients', 'Admin\PatientController@fetch');
Route::post('admin/patient/{id}/update', 'Admin\PatientController@update');

Route::post('admin/user-create', 'Admin\UserController@store');
Route::post('admin/user/{id}/update', 'Admin\UserController@update');