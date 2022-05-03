<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/list', [App\Http\Controllers\EmployeeManagementController::class, 'index'])->name('index');
Route::get('/create', [App\Http\Controllers\EmployeeManagementController::class, 'create'])->name('create');
Route::post('/store', [App\Http\Controllers\EmployeeManagementController::class, 'store'])->name('store');
Route::get('/edit/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'edit'])->name('edit');
Route::post('/update', [App\Http\Controllers\EmployeeManagementController::class, 'update'])->name('update');
Route::get('/delete/{id}', [App\Http\Controllers\EmployeeManagementController::class, 'destroy'])->name('delete');