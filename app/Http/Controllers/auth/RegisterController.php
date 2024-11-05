<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\auth\RegisterRequest;
use App\Models\User;

class RegisterController extends Controller
{
    public function show() {
        return view('temp.register');
    }

    public function register(RegisterRequest $request) {
        $user = User::create($request->validated());
        return redirect('/login');
    }
}
