<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth/login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/manageGoods', [App\Http\Controllers\ManageGoodsController::class, 'index'])->name('managegoods');
Route::get('/orderRequire', [App\Http\Controllers\orderManagementController::class, 'index'])->name('orderRequire');
Route::get('/ordermanagement', [App\Http\Controllers\orderManagementController::class, 'ordermanagement'])->name('orderManagement');
