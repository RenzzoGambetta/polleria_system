<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ClearDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        // Truncate the tables for each model
        DB::table('users')->truncate();
        DB::table('employees')->truncate();
        DB::table('clients')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_permission')->truncate();
        DB::table('supplies')->truncate();
        DB::table('brands')->truncate();
        DB::table('suppliers')->truncate();
        DB::table('persons')->truncate();
        DB::table('voucher_types')->truncate();
        DB::table('inventory_receipts')->truncate();
        DB::table('inventory_receipt_details')->truncate();
        DB::table('tables')->truncate();
        DB::table('lounges')->truncate();
        DB::table('menu_categories')->truncate();
        DB::table('menu_items')->truncate();
        DB::table('supplier_supply')->truncate();
        DB::table('combo_items')->truncate();
        DB::table('menu_supply_details')->truncate();
        DB::table('cooking_places')->truncate();
        DB::table('cashier_sessions')->truncate();

        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();
    }
}
