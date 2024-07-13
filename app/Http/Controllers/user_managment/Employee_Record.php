<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Employee_Record extends Controller
{
    protected $Navigation = [
        'seccion' => 2,
        'sub_seccion' => 2.1,
        'color' => 21
    ];
    public function employeer_list_view()
    {

        $Navigation = $this->Navigation;
        return view('user_managment.employee', compact('Navigation'));
    }
    public function employeer_register_list_view()
    {

        $Navigation = $this->Navigation;
        return view('user_managment.employee_register', compact('Navigation'));
    }
}
