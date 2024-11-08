<?php

namespace App\Services\inventory;

use App\Models\Brand;
use App\Models\Supply;
use Exception;
use Illuminate\Support\Facades\DB;

class supplyService
{
    public function __construct() {}

    public function createSupply(array $data)
    {
        DB::beginTransaction();

        try {
            if (isset($data['brand_name'])) {
                $brandName = $data['brand_name'];
                $brand = $this->getBrand($brandName);
                $data['brand_id'] = $brand->id;
            }

            $supply = Supply::create([
                'brand_id' => isset($data['brand_id']) ? $data['brand_id'] : null,
                'code' => isset($data['code']) ? $data['code'] : null,
                'name' => $data['name'],
                'is_stockable' => isset($data['is_stockable']) ? true : false,
                'stock' => isset($data['stock']) ? $data['stock'] : null,
                'unit' => isset($data['unit']) ? $data['unit'] : null,
                'note' => isset($data['note']) ? $data['note'] : null,
            ]);

            DB::commit();
            return $supply;
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function updateSupply(int $id, array $data)
    {
        DB::beginTransaction();

        try {

            // Buscar el suministro por su ID
            $supply = Supply::findOrFail($id);

            if (isset($data['brand_name'])) {
                $brandName = $data['brand_name'];
                $brand = $this->getBrand($brandName);
                $data['brand_id'] = $brand->id;
            }

            $supply->update([
                'brand_id' => isset($data['brand_id']) ? $data['brand_id'] : null,
                'code' => isset($data['code']) ? $data['code'] : null,
                'name' => $data['name'],
                'is_stockable' => isset($data['is_stockable']) ? true : false,
                'stock' => isset($data['stock']) ? $data['stock'] : null,
                'unit' => isset($data['unit']) ? $data['unit'] : null,
                'note' => isset($data['note']) ? $data['note'] : null,
            ]);

            DB::commit();
            return $supply;
        } catch (Exception $e) {
            DB::rollBack();
            return $e;
        }
    }

    public function deleteSupplyAndBrand(Supply $supply)
    {
        $brandId = $supply->brand_id;
        $brand = Brand::find($brandId);

        $supplyListByBrand = $brand->suppliers;
        if ($supplyListByBrand->count() > 1) {
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

    public function getBrand(string $name)
    {
        $brand = Brand::firstOrCreate([
            'name' => $name,
        ]);

        return $brand;
    }
}
