<?php

use App\Http\Controllers\Admin\CmspageCrudController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;

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
});

Route::get('greeting', [UserController::class, 'sayHi']);
Route::redirect('/home', 'greeting'); 

Route::controller(EmployeeController::class)->group(function () {
    Route::get('view','displayData');
    Route::get('insert','insertform');
    Route::get('insert',[EmployeeController::class,'insertform']);
    Route::post('/create','insertEmployee');

    Route::get('delete/{id}','destroy');

    Route::get('edit/{id}', 'edit');
    Route::post('update', 'update');
});

Route::get('student/create', function () {
    return view('user/create');
});

Route::get('student/login', function () {
    return view('user/login');
});

Route::controller(AuthenticationController::class)->group(function () {
    Route::post('/student_signin','signinAccount')->name('student_signin');
    Route::post('/student_register','createAccount')->name('student_register');
    Route::post('/student_signout','signoutAccount')->name('student_signout');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('employee/login', function () {
    return view('employees/login');
});

Route::controller(CmspageCrudController::class)->group(function () {
    Route::get('cms','displayData')->name('cms');
    Route::get('cms-single/{id}','displayCMSPage');
});

Route::get('user/login', function () {
    return view('user/login');
});
Route::get('window', function () {
    return view('user/window');
});
