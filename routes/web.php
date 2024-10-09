<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Newscontroller;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\UserController;

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
Route::resource('form', Newscontroller::class);
Route::resource('user', UserController::class);
Route::resource('popup', PopupController::class);
Route::delete('Delete', [Newscontroller::class, 'Delete'])->name('delete');


Route::resource('admin', AdminController::class);
Route::resource('manage', ManagementController::class);


//helpers

Route::get('/helper',[UserController::class,'helpers']);
Route::get('/send-email',[UserController::class,'Send_Email']);
Route::get('/sendemailform',[UserController::class,'SendEmailform']);
Route::post('/sendemailform',[UserController::class,'SendEmailfile'])->name('contact');
