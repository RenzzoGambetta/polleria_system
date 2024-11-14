<?php

namespace Tests\Feature;

use App\Models\inventory\InventoryMovementDetail;
use App\Models\InventoryReceipt;
use App\Models\Supplier;
use App\Models\Supply;
use App\Models\various\VoucherType;
use App\Services\inventory\SupplierService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupplierServiceTest extends TestCase
{
    use RefreshDatabase;
    protected $supplierService;

    protected function setUp() : void
    {
        parent::setUp();
        $this->supplierService = new SupplierService();
    }

    public function test_get_supply_dto_by_supplier_id()
    {
        $data = [
            'dni' => '00000001',
            'name' => 'Pepe',
            'paternal_surname' => 'Foca',
            'maternal_surname' => 'Foca',
            'birthdate' => null,
            'gender' => 'male',
            'phone' => null,
            'email' => null,
            'address' => null,
        ];

        $supplier = $this->supplierService->createSupplier($data);

        $supplies = Supply::create([
            'code' => 'ABC123',
            'name' => 'Test Supply',
            'is_stockable' => true,
            'stock' => 100,
            'unit' => 'pcs',
            'note' => 'Test note',
        ]);

        $supplier->supplies()->attach($supplies);

        VoucherType::create([
            'code' => 'BOL',
            'name' => 'boleta',
            'abbreviation' => 'BOL'
        ]);

        InventoryReceipt::create([
            'voucher_id' => 1,
            'voucher_serie' => 'B01',
            'correlative_number' => '00000001',
            'supplier_id' => $supplier->id,
            'issuance_date' => now(),
            'total_amount' => '0.00'
        ]);


        InventoryMovementDetail::create([
            'receipt_id' => 1,
            'supply_id' => $supplies->id,
            'price' => 10.00,
            'discount' => 0,
            'quantity' => 5,
            'total_amount' => 50.00,
            'note' => 'First detail',
        ]);

        InventoryMovementDetail::create([
            'receipt_id' => 2,
            'supply_id' => $supplies->id,
            'price' => 12.00,
            'discount' => 0,
            'quantity' => 3,
            'total_amount' => 36.00,
            'note' => 'Second detail',
            'updated_at' => now()->addDay(), // Asegúrate de que este sea más reciente
        ]);

        $result = $this->supplierService->getSupplyDTOBySupplierId($supplier->id);

        // Realiza las afirmaciones
        $this->assertIsArray($result);
        $this->assertCount(1, $result);
        $this->assertEquals($supplies->id, $result[0]['id']);
        $this->assertEquals('ABC123', $result[0]['code']);
        $this->assertEquals('Test Supply', $result[0]['name']);
        $this->assertEquals(12.00, $result[0]['lastPrice']);
        $this->assertEquals(3, $result[0]['lastQuantity']);
    }

    public function test_get_supply_dto_by_nonexistent_supplier_id()
    {
        // Llama al método con un ID que no existe
        $result = $this->supplierService->getSupplyDTOBySupplierId(999);

        // Realiza la afirmación
        $this->assertEquals('No se encontró un proveedor con ese id', $result);
    }
}
