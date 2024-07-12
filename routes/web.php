<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\Login;
use App\Http\Controllers\user_managment\User;

Route::get('/', [Login::class,'index_view'])->name('login');

Route::get('/login', [Login::class,'index_view'])->name('login');
Route::post('/session', [Login::class,'session'])->name('session');

Route::get('/user', [User::class,'user_list_view'])->name('user');
Route::get('/user', [User::class,'user_list_view'])->name('user');
Route::get('/employeer', [User::class,'employeer_list_view'])->name('employeer');
Route::get('/position', [User::class,'position_list_view'])->name('position');

Route::get('/home', [User::class,'home_list_view'])->name('home');
