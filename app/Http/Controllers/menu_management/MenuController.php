<?php

namespace App\Http\Controllers\menu_management;

use App\Http\Controllers\Controller;
use App\Http\Global\ConstGlobal;
use App\Http\Global\FunctionGlobal;
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
    protected $Navigation, $NavigationCart;

    public function __construct()
    {
        $this->Navigation = FunctionGlobal::NavigationFast(4, 0);
        $this->NavigationCart = FunctionGlobal::NavigationFast(4, 1);
    }
    public function showMenuList(Request $request)
    {
        $Navigation = $this->Navigation;
        $filt = $request->input('filt', 'default');
        $buttonMap = ['combo' => 1, 'menu' => 2];

        $Data = ['button' => $buttonMap[$filt] ?? 3];
        $query = MenuItem::query();

        if ($filt === 'combo') {
            $query->where('is_combo', 1);
        } elseif ($filt === 'menu') {
            $query->where('is_combo', 0);
        }

        $Menu = $query->paginate((ConstGlobal::PAGINATION - 3))->appends(['filt' => $filt]);

        return view('menu_management.menu', compact('Navigation', 'Menu', 'Data'));
        //return response()->json($Data);

    }
    public function newMenuAndEdit(Request $request)
    {
        try {

            $Data = [
                'Title' => 'Nuevo plato o bebida',
                'Toggle' => true,
                'SubTitle' => 'Conjunto que conforma un plato o bebida',
                'Input' => 'Suministro',
                'button_type' => $request->button_type ?? 0,
            ];

            if ($request->direction == "cart") {
                $Navigation = $this->NavigationCart;
                $Data['UrlCancel'] = 'show_order_item';
                $Data['UrlComplement'] = '?category_id=' . $request->id;
                $Category = MenuCategory::where('id', $request->id)->first();
                $Data['idCategory'] = $Category->id;
                $Data['nameCategory'] = $Category->name;
            } else {
                $Navigation = $this->Navigation;
                if ($request->option != null) {
                    $ComboItem = MenuItem::where('id', $request->option)->first();
                    $Data = [
                        'Title' => ($ComboItem->is_combo == 1) ? 'Editador de Combo' : 'Editador de Plato o Bebida',
                        'UrlCancel' => 'menu',
                        'Toggle' => false,
                        'SubTitle' => ($ComboItem->is_combo == 1) ? 'Conjunto que conforma un Combo' : 'Conjunto que conforma un plato o bebida',
                        'Input' => ($ComboItem->is_combo == 1) ? 'Item' : 'Suministro',

                    ];
                    return view('menu_management.new_menu_and_edit', compact('Navigation', 'ComboItem', 'Data'));
                }
                $Data['UrlCancel'] = 'menu';
            }

            //return response()->json($Data);
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
            $item = DB::table('menu_supply_details as msd')
                ->join('supplies as s', 'msd.supply_id', '=', 's.id')
                ->select('msd.supply_quantity as quantity', 'msd.supply_id as id', 's.name')
                ->where('item_id', $id)
                ->get();
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
        //$Category = MenuCategory::orderBy('display_order')->get();
        $Category = MenuCategory::withCount('items')->orderBy('display_order')->get();
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
            $menuItem = $menuItemService->editMenuItem($request->id, $request->validated());

            return redirect()->route('menu');
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    public function registerNewMenu(MenuItemRequest $request)
    {
        //return response()->json($request);

        $menuItemService = new MenuItemService();
        try {
            $menuItem = $menuItemService->createMenuItem($request->validated());

            return redirect()->route('menu');
        } catch (Exception $e) {
            return $e;
        }
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
    public function editToCategory(Request $request)
    {
        try {
            $category = MenuCategory::find($request->id);

            if (!$category) {
                return response()->json(['response' => false]);
            }

            $newName = $request->input('name');
            $newOrder = (int) $request->input('display_order');
            $oldOrder = $category->display_order;

            // Si el nuevo orden es diferente, ajustamos el display_order
            if ($newOrder !== $oldOrder) {
                $this->adjustDisplayOrder($oldOrder, $newOrder, $category->id);
            }

            // Actualizar la categoría con el nuevo nombre y orden
            $category->name = $newName;
            $category->display_order = $newOrder;
            $category->save();

            // Reordenar la lista para evitar duplicados
            $this->fillDisplayOrderGaps();

            return response()->json(['response' => true]);
        } catch (Exception $e) {
            return response()->json(['response' => false]);
        }
    }

    /**
     * Ajusta el orden de las categorías desplazando los elementos según sea necesario.
     */
    private function adjustDisplayOrder($oldOrder, $newOrder, $categoryId)
    {
        if ($newOrder < $oldOrder) {
            // Mover las categorías hacia adelante
            MenuCategory::whereBetween('display_order', [$newOrder, $oldOrder - 1])
                ->where('id', '!=', $categoryId)
                ->increment('display_order');
        } else {
            // Mover las categorías hacia atrás
            MenuCategory::whereBetween('display_order', [$oldOrder + 1, $newOrder])
                ->where('id', '!=', $categoryId)
                ->decrement('display_order');
        }
    }

    /**
     * Asegura que los display_order sean secuenciales sin huecos.
     */
    private function fillDisplayOrderGaps()
    {
        $categories = MenuCategory::orderBy('display_order', 'asc')->get();
        $expectedOrder = 1;

        foreach ($categories as $category) {
            if ($category->display_order != $expectedOrder) {
                $category->display_order = $expectedOrder;
                $category->save();
            }
            $expectedOrder++;
        }
    }
    public function deleteToCategory(Request $request)
    {
        try {
            $category = MenuCategory::find($request->id);

            if (!$category) {
                return response()->json(['response' => false]);
            }

            $category->delete();

            // Reordenar la lista para evitar duplicados
            $this->fillDisplayOrderGaps();

            return response()->json(['response' => true]);
        } catch (Exception $e) {
            return response()->json(['response' => false]);
        }
    }

    public function deleteToMenuItem(Request $request)
    {
        try {
            $Menu = MenuItem::find($request->id);
            $nameMenuDelete = $Menu->name;
            if (!$Menu) {
                return response()->json(['response' => false]);
            }

            $Menu->delete();

            // Reordenar la lista para evitar duplicados
            $this->fillDisplayOrderGaps();

            return redirect()->route('menu')->with(FunctionGlobal::MessageSuccess('Se eliminso correctamente el Item: '.$nameMenuDelete));
        } catch (Exception $e) {
            return redirect()->route('menu')->with(FunctionGlobal::MessageError('No aw pudo eliminar el item: '.$nameMenuDelete));
        }
    }
}
