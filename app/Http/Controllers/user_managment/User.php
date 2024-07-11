<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User extends Controller
{
    public function user_list_view()
    {
        $Data = session('Data');
        return view('user_managment.user', compact('Data'));
    }
}
