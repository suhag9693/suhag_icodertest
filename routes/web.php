<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AuthController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');
Route::get('login',[AuthController::class,'index'])->name('login');
Route::get('logout',[AuthController::class,'logout'])->name('logout');
Route::post('login',[AuthController::class,'logincheck'])->name('login.check');

Route::group(['middleware' => 'admin'], function () {
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::resource('departments', DepartmentController::class);
    Route::resource('employees', EmployeeController::class);
    Route::get('users', [EmployeeController::class, 'list'])->name('list');
    Route::get('pdf-report', [EmployeeController::class, 'generatePdfReport'])->name('employees.pdf.report');
});
