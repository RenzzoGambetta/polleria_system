<?php

namespace App\Http\Controllers\user_managment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class User extends Controller
{
    public function user_list_view()
    {
        $Data = session('Data');
        $Navigation = [
            'seccion' => 2,
            'sub_seccion' => 2.0,
            'color' => 20

        ];

        $Data = session('Data');
        return view('user_managment.user', compact('Data','Navigation'));
    }
  
    public function position_list_view()
    {
        $Data = session('Data');
        $Navigation = [
            'seccion' => 2,
            'sub_seccion' => 2.2,
            'color' => 22
        ];
        return view('user_managment.workload', compact('Data','Navigation'));
    }
    public function home_list_view()
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
