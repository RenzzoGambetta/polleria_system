<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $Navigation = [
        'seccion' => 2,
        'sub_seccion' => 2.2,
        'color' => 22
    ];
    public function show_position_list()
    {
        $Navigation = $this->Navigation;
        return view('user_managment.workload', compact('Navigation'));
    }
    public function show_role_register()
    {
        $Navigation = $this->Navigation;
        return view('user_managment.role_register', compact('Navigation'));
    }
}
