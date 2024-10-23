<?php

namespace App\Http\Controllers\menu_management;

use App\Http\Controllers\Controller;
use App\Models\menu\MenuCategory;
use App\Models\menu\MenuItem;
use Illuminate\Http\Request;


class MenuController extends Controller
{
    protected $Navigation = [
        'seccion' => 4,
        'sub_seccion' => 4.0,
        'color' => 40
    ];
    protected $NavigationMenu = [
        'seccion' => 4,
        'sub_seccion' => 4.1,
        'color' => 41
    ];

    public function showMenuList(Request $request)
    {
        $filt = $request->input('filt');
        $Url =['filt' => $filt];

        if($filt == "combo"){
            $Data = [
                'butthon' => 1,
            ];

            $Menu = MenuItem::where('is_combo', 1)->paginate(6)->appends($Url);
        }else if($filt == "menu"){
            $Data = [
                'butthon' => 2,
            ];
            $Menu = MenuItem::where('is_combo', 0)->paginate(6)->appends($Url);

        }else{
            $Data = [
                'butthon' => 3,
            ];
            $Menu = MenuItem::paginate(8);

        }
        $Navigation = $this->Navigation;
        return view('menu_management.menu', compact('Navigation', 'Menu','Data'));
        //return response()->json($Menu);

    }
    public function newMenuAndEdit(Request $request)
    {
        $direction = $request->input('direction');

        if($direction == "menu"){
            $Navigation = $this->NavigationMenu;
        }else{
            $Navigation = $this->Navigation;
        }
        return view('menu_management.new_menu_and_edit', compact('Navigation'));
        //return response()->json($Menu);

    }

    public function categoryCarte()
    {
        $Navigation = $this->NavigationMenu;
        $Category = MenuCategory::orderBy('display_order')->get();
        return view('menu_management.category_carte', compact('Navigation','Category'));
        //return response()->json($Menu);

    }
    public function newMenuCategories(Request $request)
    {
        
        //return response()->json($);

    }
}
