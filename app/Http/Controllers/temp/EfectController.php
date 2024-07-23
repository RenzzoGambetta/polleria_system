<?php

namespace App\Http\Controllers\temp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EfectController extends Controller
{
    public function switch_theme(Request $request)
    {
        $theme = $request->input('theme');
        session(['theme' => $theme]);
        return response()->json(['status' => 'Theme switched']);
    }
}
