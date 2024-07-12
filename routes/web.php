<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\user_managment\User;
use App\Http\Controllers\user_managment\Employee_Record;


Route::get('/', [LoginController::class,'show'])->name('login');

Route::get('/login', [LoginController::class,'show'])->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::get('/register', [RegisterController::class,'show'])->name('register');
Route::post('/register', [RegisterController::class,'register']);

Route::get('/user', [User::class,'user_list_view'])->name('user');
Route::get('/user', [User::class,'user_list_view'])->name('user');
Route::get('/employeer', [Employee_Record::class,'employeer_list_view'])->name('employeer');
Route::get('/employeer_register', [Employee_Record::class,'employeer_register_list_view'])->name('employeer_register');
Route::get('/position', [User::class,'position_list_view'])->name('position');

Route::get('/home', [User::class,'home_list_view'])->name('home');
