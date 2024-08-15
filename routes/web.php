<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('hospital-management/patient/signup',function () {
    return view('patientsignup');
});

Route::get('dashboard',function () {
    return view('dashboard');
})->name('patientDashboard');


Route::post('hospital-management/patient/save/', [PatientController::class, 'saveNewPatient'])->name('patient.new.store');
Route::post('hospital-management/signin', function(){
    return view('login');
});
Route::get('hospital-management/hospital-login-authenticate',[GeneralController::class,'authentication'])->name('hospital.login');