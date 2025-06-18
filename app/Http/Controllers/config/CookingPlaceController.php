<?php

namespace App\Http\Controllers\config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;

class CookingPlaceController extends Controller
{
    protected $Navigation;

    public function __construct()
    {
        $this->Navigation = FunctionGlobal::NavigationFast(7,2);
    }

    public function showCookingPlace()
    {
        $Navigation = $this->Navigation;
        
        return view('config.cooking_place', compact('Navigation'));
    }
}
