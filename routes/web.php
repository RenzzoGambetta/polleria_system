<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\user_managment\UserController;
use App\Http\Controllers\user_managment\EmployeeController;
use App\Http\Controllers\user_managment\RoleController;
use App\Http\Controllers\temp\EfectController;


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
Route::post('/create_employee_record', [EmployeeController::class,'create_employee_record'])->name('create_employee_record');
Route::get('/position', [RoleController::class,'show_position_list'])->name('position');
Route::get('/role_register', [RoleController::class,'show_role_register'])->name('role_register');

Route::get('/home', [UserController::class,'show_home_list'])->name('home');


Route::post('/switch_theme_', [EfectController::class, 'switch_theme']);
