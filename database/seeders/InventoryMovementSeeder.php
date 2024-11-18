<?php

namespace Database\Seeders;

use App\Models\inventory\InventoryMovementDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InventoryMovementSeeder extends Seeder
{
    public function run(): void
    {
        InventoryMovementDetail::factory()->count(5)->receipt()->create();

        InventoryMovementDetail::factory()->count(5)->issue()->create();
    }
}
