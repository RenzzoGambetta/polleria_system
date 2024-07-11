<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\Login;
use App\Http\Controllers\user_managment\User;

Route::get('/', [Login::class,'index_view'])->name('login');

Route::get('/login', [Login::class,'index_view'])->name('login');
Route::post('/session', [Login::class,'session'])->name('session');

Route::get('/user', [User::class,'user_list_view'])->name('user');
