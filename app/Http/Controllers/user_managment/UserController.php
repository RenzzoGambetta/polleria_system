<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Employee;

class UserController extends Controller
{
    public function show_user_list()
    {

        $Navigation = [
            'seccion' => 2,
            'sub_seccion' => 2.0,
            'color' => 20

        ];

        $List = Employee::paginate(6);
        return view('user_managment.employee', compact('Navigation', 'List'));
    }


    public function show_home_list()
    {

        $Navigation = [
            'seccion' => 1,
            'sub_seccion' => 1.0,
            'color' => 10
        ];
         $List = Employee::paginate(6);
        return view('user_managment.employee', compact('Navigation', 'List'));

    }
}
