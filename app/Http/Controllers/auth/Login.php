<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Login extends Controller
{
    public function index_view()
    {
        return view('auth.login');
    }
    public function session(Request $request){

        $Data = $request->only('username', 'password');
        //Servicio de validacion
        session(['Data' => $Data]);
        return redirect()->route('user');

    }
}
