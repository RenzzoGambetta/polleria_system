<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show_user_list()
    {
        $Data = session('Data');
        $Navigation = [
            'seccion' => 2,
            'sub_seccion' => 2.0,
            'color' => 20

        ];
        $users = User::all();

        $Data = session('Data');
        return view('user_managment.user', compact('Data','Navigation', 'users'));
    }

   
    public function show_home_list()
    {
        $Data = session('Data');
        $Navigation = [
            'seccion' => 1,
            'sub_seccion' => 1.0,
            'color' => 10
        ];
        return view('user_managment.user', compact('Data','Navigation'));
    }
}
