<?php

namespace App\Services\menu;

use App\Models\menu\MenuItem;
use Exception;
use Illuminate\Support\Facades\DB;

class MenuItemService
{
    public function __construct(){}

    public function createMenuItem(array $data)  
    {
        DB::beginTransaction();
        try {
            $menuItem = MenuItem::create([
                'category_id' => $data['category_id'] ?? null,
                'cooking_place_id' => $data['cooking_place_id'] ?? null,
                'name' => $data['name'],
                'price' => $data['price'],
                'commentary' => $data['comment'],
            ]);

            for ($i=0; $i < count($data['id_item_compact']); $i++) { 
                $menuItem->supplyDetails()->attach($data['id_item_compact'][$i], [
                    'supply_quantity' => $data['quantity_item_compact'][$i],
                ]);
            }
            
            DB::commit();
            return $menuItem;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
