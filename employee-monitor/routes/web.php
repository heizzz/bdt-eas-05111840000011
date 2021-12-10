<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\EmployeeController as EmployeeController;
use App\Http\Controllers\SalaryController as SalaryController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/search',[EmployeeController::class, 'search'])->name('search');

Route::group(['prefix' => 'employee'], function(){
    Route::get('create',[EmployeeController::class, 'create'])->name('employee-create');
    Route::post('store',[EmployeeController::class, 'store'])->name('employee-store');
    Route::get('{id}/edit',[EmployeeController::class, 'edit'])->name('employee-edit');
    Route::put('update',[EmployeeController::class, 'update'])->name('employee-update');
    Route::delete('{id}/delete',[EmployeeController::class, 'delete'])->name('employee-delete');
    Route::get('{id}',[EmployeeController::class, 'detail'])->name('detail');

    Route::group(['prefix' => '{id}/salary'], function(){
        Route::get('create',[SalaryController::class, 'create'])->name('salary-create');
        Route::post('store',[SalaryController::class, 'store'])->name('salary-store');
        Route::get('{id_salary}/edit',[SalaryController::class, 'edit'])->name('salary-edit');
        Route::put('update',[SalaryController::class, 'update'])->name('salary-update');
        Route::delete('{id_salary}/delete',[SalaryController::class, 'delete'])->name('salary-delete');
    });
});
