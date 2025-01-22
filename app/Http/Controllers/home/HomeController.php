<?php

namespace App\Http\Controllers\home;

use App\Http\Controllers\Controller;
use App\Http\Controllers\order\MozoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    protected $Navigation = [
        'seccion' => 1,
        'sub_seccion' => 1.0,
        'color' => 10
    ];

    public function showHomePanel()
    {
        $Navigation = $this->Navigation;

        $user = Auth::user();

        if ($user && $user->role) {

            $permission = $user->role->permissions;

            if ($permission->whereIn('id', [5, 6])) {
                $Data = (new MozoController)->queryDataSaleOption(7,1);
                $Option = [
                    'id' => 0
                ];
            
                return view('home.home_panel', compact('Navigation', 'Data', 'Option'));
            }
        } 
      
        return view('home.home_panel', compact('Navigation'));
        
    }
    public function unauthorizedZone(Request $Data){
        $intentedUrl = session('intentedUrl');
        $routeName = session('routeName');
    
        return view('home.unauthorized_zone');
    }
}

