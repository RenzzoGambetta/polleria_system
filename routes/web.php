<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\user_managment\User;


Route::get('/', [LoginControllerController::class,'show'])->name('login');

Route::get('/login', [LoginController::class,'show'])->name('login');
Route::post('/login', [LoginController::class,'login']);
Route::get('/register', [RegisterController::class,'show'])->name('register');
Route::post('/register', [RegisterController::class,'register']);

Route::get('/user', [User::class,'user_list_view'])->name('user');
