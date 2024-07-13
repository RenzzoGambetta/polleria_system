<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    protected $Navigation = [
        'seccion' => 2,
        'sub_seccion' => 2.1,
        'color' => 21
    ];
    public function show_employeer_list()
    {

        $Navigation = $this->Navigation;
        return view('user_managment.employee', compact('Navigation'));
    }
    public function show_employeer_register()
    {

        $Navigation = $this->Navigation;
        return view('user_managment.employee_register', compact('Navigation'));
    }
}
