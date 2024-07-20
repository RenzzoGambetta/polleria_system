<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\user_managment\UserController;
use App\Http\Controllers\user_managment\EmployeeController;


Route::get('/', [LoginController::class,'show'])->name('login');

Route::get('/login', [LoginController::class,'show'])->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::get('/register', [RegisterController::class,'show'])->name('register');
Route::post('/register', [RegisterController::class,'register']);

Route::get('/user', [UserController::class,'show_user_list'])->name('user');
Route::get('/user', [UserController::class,'show_user_list'])->name('user');
Route::get('/employeer', [EmployeeController::class,'show_employeer_list'])->name('employeer');
Route::get('/employeer_register', [EmployeeController::class,'show_employeer_register'])->name('employeer_register');
Route::get('/fetch_person_data', [EmployeeController::class,'fetch_person_data'])->name('fetch_person_data');
Route::get('/position', [UserController::class,'show_position_list'])->name('position');

Route::get('/home', [UserController::class,'show_home_list'])->name('home');
