<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\destinationManagementController;
use App\Http\Controllers\goodsManagementController;
use App\Http\Controllers\memberManagementController;
use App\Http\Controllers\orderManagementController;
use App\Http\Controllers\orderRequestController;

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

// Route::post('/members/newmember', [App\Http\Controllers\manageMembersController::class, 'createNewMember'])->name('newMember');

Route::get('/goods/download/{id}', [goodsManagementController::class, 'download'])->name('goodsDownload');
Route::post('/goods/upload/{id}', [goodsManagementController::class, 'upload'])->name('goodsupload');
Route::resource('/members', memberManagementController::class);
Route::resource('/orders', orderManagementController::class);
Route::resource('/goods', goodsManagementController::class);
Route::resource('/destination', destinationManagementController::class);
Route::resource('/orderRequest', orderRequestController::class);

