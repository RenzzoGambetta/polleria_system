<?php

namespace App\Services\inventory;

use App\Models\Brand;
use App\Models\Supply;
use Exception;
use Illuminate\Support\Facades\DB;

class supplyService
{
    public function __construct(){}

    public function createSupply(array $data) {
        DB::beginTransaction();

        try {
            $brandName = $data['brand_name'];
            $brand = $this->getBrand($brandName);

            $supply = Supply::create([
                'brand_id' => $brand->id,
                'code' => $data['code'],
                'name' => $data['name'],
                'is_stockable' => $data['is_stockable'],
                'stock' => $data['stock'],
                'unit' => $data['unit'],
                'note' => $data['note'],
            ]);

            DB::commit();
            return $supply;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function updateSupply(Supply $supply, array $data) {
        DB::beginTransaction();

        try {
            $brandName = $data['brand_name'];
            $brand = $this->getBrand($brandName);

            $supply->update([
                'brand_id' => $brand->id,
                'code' => $data['code'],
                'name' => $data['name'],
                'is_stockable' => $data['is_stockable'],
                'stock' => $data['stock'],
                'unit' => $data['unit'],
                'note' => $data['note'],
            ]);

            DB::commit();
            return $supply;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function deleteSupplyAndBrand(Supply $supply) {
        $brandId = $supply->brand_id;
        $brand = Brand::first($brandId);

        $productListByBrand = $brand->suppliers;
        if ($productListByBrand > 1) {
            throw new Exception("La marca está relacionado con otros insumos");
        }

        DB::beginTransaction();
        try {
            $supply->delete();
            $brand->delete();

            DB::commit();
            return true;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    } 

    public function getBrand(string $name) {
        $brand = Brand::firstOrCreate([
            'name' => $name,
        ]);

        return $brand;
    }
}
