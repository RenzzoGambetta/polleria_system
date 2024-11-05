<?php

namespace Tests\Feature\ServiceTest;

use App\Models\Brand;
use App\Models\Supply;
use App\Services\inventory\supplyService;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupplyServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $supplyService;

    protected function setUp() : void
    {
        parent::setUp();
        $this->supplyService = new supplyService();
    }

    public function test_delete_supply_and_brand_throws_exception_brand_with_supplies() 
    {
        $brand = Brand::create([
            'name' => 'Brand A',
            'description' => 'Description for Brand A'
        ]);

        // Crear dos suministros asociados a la misma marca
        $supply1 = Supply::create([
            'brand_id' => $brand->id,
            'code' => 'CODE1',
            'name' => 'Supply 1',
            'is_stockable' => true,
            'stock' => 10,
            'unit' => 'pcs',
            'note' => 'First supply'
        ]);

        $supply2 = Supply::create([
            'brand_id' => $brand->id,
            'code' => 'CODE2',
            'name' => 'Supply 2',
            'is_stockable' => true,
            'stock' => 20,
            'unit' => 'pcs',
            'note' => 'Second supply'
        ]);

        // Intentar eliminar el primer suministro
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("La marca está relacionado con otros insumos");

        $this->supplyService->deleteSupplyAndBrand($supply1);
    }
}
