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
            if (!empty($data['id_item_compact'])){
                if ($data['is_combo'] == 1) {
                    $this->attachItemsToMenuCombo($menuItem, $data);
                }
                else {
                    $this->attachSuppliesToMenuItem($menuItem, $data);
                }
            }

            DB::commit();
            return $menuItem;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function editMenuItem(int $id, array $data)
    {
        $menuItem = MenuItem::findOrFail($id);

        DB::beginTransaction();
        try{
            $menuItem->update([
                'category_id' => $data['category_id'] ?? null,
                'cooking_place_id' => $data['cooking_place_id'] ?? null,
                'name' => $data['name'],
                'price' => $data['price'],
                'commentary' => $data['comment'],
            ]);
            if (!empty($data['id_item_compact'])) {
                if ($data['is_combo'] == 1) {
                    $this->attachItemsToMenuCombo($menuItem, $data);
                }
                else {
                    $this->attachSuppliesToMenuItem($menuItem, $data);
                }
            }

            DB::commit();
            return $menuItem;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    private function attachSuppliesToMenuItem(MenuItem $menuItem, array $data)
    {
        $menuItem->supplyDetails()->detach();
            for ($i=0; $i < count($data['id_item_compact']); $i++) {
                $menuItem->supplyDetails()->attach($data['id_item_compact'][$i], [
                    'supply_quantity' => $data['quantity_item_compact'][$i],
                ]);
            }
    }

    private function attachItemsToMenuCombo(MenuItem $menuItem, array $data)
    {
        $menuItem->comboDetails()->detach();
            for ($i=0; $i < count($data['id_item_compact']); $i++) {
                $menuItem->supplyDetails()->attach($data['id_item_compact'][$i], [
                    'supply_quantity' => $data['quantity_item_compact'][$i],
                ]);
            }
    }
}
