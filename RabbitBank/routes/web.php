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


Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/transfer', [App\Http\Controllers\TransferController::class, 'index'])->name('transfer');

Route::post('/transfer/confirming', [App\Http\Controllers\TransferController::class, 'confirming'])->name('confirming');

Route::post('/transfer/confirming/success', [App\Http\Controllers\TransferController::class, 'success'])->name('success');
Route::view('/transfer/confirming/canceled','canceled');

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']);
Route::post('/admin/processing', [App\Http\Controllers\AdminController::class, 'processing']);

Route::get('/admin/transactions', [App\Http\Controllers\AdminController::class, 'transactions']);
Route::get('/admin/adduser', [App\Http\Controllers\AdminController::class, 'adduser']);

Route::post('/admin/addinguser', [App\Http\Controllers\AdminController::class, 'addinguser']);



