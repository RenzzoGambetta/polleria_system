<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use App\Models\Role;
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

        $roles = Role::all();
        return view('user_managment.workload', compact('Navigation', 'roles'));
    }
    public function show_role_register()
    {
        $Navigation = $this->Navigation;
        return view('user_managment.role_register', compact('Navigation'));
    }
}
