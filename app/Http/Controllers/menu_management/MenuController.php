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
        $Url = ['filt' => $filt];

        if ($filt == "combo") {
            $Data = [
                'butthon' => 1,
            ];

            $Menu = MenuItem::where('is_combo', 1)->paginate(6)->appends($Url);
        } else if ($filt == "menu") {
            $Data = [
                'butthon' => 2,
            ];
            $Menu = MenuItem::where('is_combo', 0)->paginate(6)->appends($Url);
        } else {
            $Data = [
                'butthon' => 3,
            ];
            $Menu = MenuItem::paginate(8);
        }
        $Navigation = $this->Navigation;
        return view('menu_management.menu', compact('Navigation', 'Menu', 'Data'));
        //return response()->json($Menu);

    }
    public function newMenuAndEdit(Request $request)
    {
        $direction = $request->input('direction');

        if ($direction == "menu") {
            $Navigation = $this->NavigationMenu;
        } else {
            $Navigation = $this->Navigation;
        }
        return view('menu_management.new_menu_and_edit', compact('Navigation'));
        //return response()->json($Menu);

    }

    public function categoryCarte()
    {
        $Navigation = $this->NavigationMenu;
        $Category = MenuCategory::orderBy('display_order')->get();
        return view('menu_management.category_carte', compact('Navigation', 'Category'));
        //return response()->json($Menu);

    }
    public function newMenuCategories(Request $request)
    {

        // Validación de los campos
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'display_order' => 'required|integer',
        ]);

        $name = $validatedData['name'];
        $displayOrder = $validatedData['display_order'];

        // Ajustar el display_order en caso de que ya exista
        if (MenuCategory::where('display_order', '>=', $displayOrder)->exists()) {
            MenuCategory::where('display_order', '>=', $displayOrder)->increment('display_order');
        }

        // Crear el nuevo registro con el display_order ajustado
        $newRecord = MenuCategory::create([
            'name' => $name,
            'display_order' => $displayOrder,
        ]);

        // Devolver el nuevo registro en formato JSON
        return response()->json([
            'id' => $newRecord->id,
            'name' => $newRecord->name,
            'display_order' => $newRecord->display_order,
            'response' => true
        ]);
    }
    public function editToOrderCategori(Request $request){
        // Obtener los datos enviados como objeto
        $data = $request->all(); // Esto debería recibir el objeto con ids y display_order

        // Iterar sobre el array para actualizar cada registro
        foreach ($data as $id => $display_order) {
            // Encontrar el registro por id y actualizar su display_order
            $category = MenuCategory::find($id); // Reemplaza con tu modelo

            if ($category) {
                $category->display_order = $display_order;
                $category->save(); // Guardar los cambios
            }
        }

        // Devolver una respuesta JSON
        return response()->json($data);
    }
}
