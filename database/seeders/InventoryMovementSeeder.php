<?php

namespace Database\Seeders;

use App\Models\InventoryReceiptDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryMovementSeeder extends Seeder
{
    public function run(): void
    {
        InventoryReceiptDetails::factory()->count(5)->receipt()->create();

        // InventoryReceiptDetails::factory()->count(5)->issue()->create();
    }
}
