<?php

namespace App\Http\Controllers\menu_management;

use App\Http\Controllers\Controller;
use App\Http\Requests\menu\MenuItemRequest;
use App\Models\menu\CookingPlace;
use App\Models\menu\MenuCategory;
use App\Models\menu\MenuItem;
use App\Models\Supply;
use App\Services\menu\MenuItemService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Runner\Extension\Extension;

class MenuController extends Controller
{
    protected $Navigation = [
        'seccion' => 4,
        'sub_seccion' => 4.0,
        'color' => 40
    ];
    protected $NavigationCart = [
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
                'button' => 1,
            ];

            $Menu = MenuItem::where('is_combo', 1)->paginate(6)->appends($Url);
        } else if ($filt == "menu") {
            $Data = [
                'button' => 2,
            ];
            $Menu = MenuItem::where('is_combo', 0)->paginate(6)->appends($Url);
        } else {
            $Data = [
                'button' => 3,
            ];
            $Menu = MenuItem::paginate(8);
        }
        $Navigation = $this->Navigation;
        return view('menu_management.menu', compact('Navigation', 'Menu', 'Data'));
        //return response()->json($Menu);

    }
    public function newMenuAndEdit(Request $request)
    {
        try {

            $direction = $request->input('direction');
            $option = $request->input('option');
            $id = $request->input('id');

            $Data = [
                'Title' => 'Nuevo plato o bebida',
                'Toggle' => true,
                'SubTitle' => 'Conjunto que conforma un plato o bebida',
                'Input' => 'Suministro',
            ];
            if ($direction == "cart") {
                $Navigation = $this->NavigationCart;
                $Data['UrlCancel'] = 'show_order_item';
                $Data['UrlComplement'] = '?category_id='.$id;
                $Category = MenuCategory::where('id', $id)->first();
                $Data['idCategory'] = $Category->id;
                $Data['nameCategory'] = $Category->name;

            } else {
                $Navigation = $this->Navigation;
                if ($option != null) {
                    $ComboItem = MenuItem::where('id', $option)->first();
                    $Data = [
                        'Title' => ($ComboItem->is_combo == 1) ? 'Editador de Combo' : 'Editador de Plato o Bebida',
                        'UrlCancel' => 'menu',
                        'Toggle' => false,
                        'SubTitle' => 'Conjunto que conforma un Combo',
                        'Input' => 'Item',
                    ];


                    return view('menu_management.new_menu_and_edit', compact('Navigation', 'ComboItem', 'Data'));
                }
                $Data['UrlCancel'] = 'menu';
            }

            return view('menu_management.new_menu_and_edit', compact('Navigation', 'Data'));
        } catch (Extension $e) {
            return abort(404);
        }
    }
    public function filtItemData(Request $request)
    {
        $id = $request->input('id'); //1
        $combo = $request->input('combo'); //0

        if ($combo == 0) {
            $item = Supply::select('id', 'stock as quantity', 'name')->get();
        } else if ($combo == 1) {

            //Consulta sql a la tabla combo_item_details
            $item = DB::table('combo_item_details as cid')
                ->join('supplies as s', 'cid.item_id', '=', 's.id')
                ->select('cid.combo_id as id', 's.name as name', 'cid.item_quantity as quantity')
                ->where('cid.combo_id', $id)
                ->get();
        }
        return response()->json($item);
    }
    public function categoryCarte()
    {
        $Navigation = $this->NavigationCart;
        $Category = MenuCategory::orderBy('display_order')->get();
        return view('menu_management.category_carte', compact('Navigation', 'Category'));
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
    public function editToOrderCategori(Request $request)
    {
        $data = $request->all();
        foreach ($data as $id => $display_order) {
            $category = MenuCategory::find($id);

            if ($category) {
                $category->display_order = $display_order;
                $category->save();
            }
        }
        return response()->json($data);
    }
    public function listOfItem()
    {
        $item = MenuItem::select('id', 'name')->where('is_combo', 0)->get();
        return response()->json($item);
    }
    public function listOfCategory()
    {
        $item = MenuCategory::select('id', 'name')->get();
        return response()->json($item);
    }
    public function editNewMenu(MenuItemRequest $request)
    {

        //return response()->json($request);
        $menuItemService = new MenuItemService();
        try {
            $menuItem = $menuItemService->editMenuItem($request->id ,$request->validated());

            return redirect()->route('menu');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function registerNewMenu(MenuItemRequest $request)
    {
        /*
        *   Implementacion temporal de la creacion de nuevos items del menu, modifical con tu logica
        */
       
        $menuItemService = new MenuItemService();
        try {
            $menuItem = $menuItemService->createMenuItem($request->validated());

            return redirect()->route('menu');
        } catch (Exception $e) {
            return $e;
        }
        
        return $request->validated();
    }
    public function showOrderItem(Request $request)
    {
        try {

            $idCategory = $request->input('category_id');
            $CategoryData = MenuCategory::where('id', $idCategory)->first();

            if ($CategoryData == null) {
                return abort(404);
            }

            $Data = [
                'Title' => $CategoryData->name,
                'Id' => $idCategory,
            ];
            $Navigation = $this->NavigationCart;
            $Item = MenuItem::orderBy('display_order')->where('category_id', $idCategory)->get();
            return view('menu_management.item_order', compact('Navigation', 'Item', 'Data'));
        } catch (Extension $e) {
            return abort(404);
        }
    }
    public function editToOrderItem(Request $request)
    {
        $data = $request->all();
        foreach ($data as $id => $display_order) {
            $item = MenuItem::find($id);

            if ($item) {
                $item->display_order = $display_order;
                $item->save();
            }
        }
        return response()->json($data);
    }
    public function listOfCookingPlace()
    {
        $data = CookingPlace::select('id', 'name')->get();
        return response()->json($data);
    }
}
