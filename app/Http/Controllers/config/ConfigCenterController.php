<?php

namespace App\Http\Controllers\config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;

class ConfigCenterController extends Controller
{
    protected $Navigation;

    public function __construct()
    {
        $this->Navigation = FunctionGlobal::NavigationFast(7,0);
    }

    public function showPanelConfig()
    {
        $Navigation = $this->Navigation;
        
        return view('config.comfig_center', compact('Navigation'));
    }
}
