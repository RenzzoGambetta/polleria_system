<?php

namespace App\Http\Controllers\temp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EfectController extends Controller
{
    public function switch_theme(Request $request)
    {
        $theme = $request->query('theme');
        session(['theme' => $theme]);
        return response()->json(['status' => 'Theme switched']);
    }
    public function updateMenuState(Request $request)
    {
        $state = $request->query('state'); 
        session(['menu_state' => $state]);

        return response()->json(['status' => 'State updated']);
    }
}
