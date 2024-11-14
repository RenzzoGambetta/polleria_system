<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Supplier;
use App\Models\Brand;
use App\Models\Client;
use App\Models\inventory\InventoryMovementDetail;
use App\Models\InventoryReceipt;
use App\Models\Supply;
use App\Models\VoucherType;
use App\Models\menu\Lounge;
use App\Models\menu\MenuCategory;
use App\Models\menu\MenuItem;
use App\Models\menu\Table as MenuTable;
use App\Models\Table;
use Database\Factories\Menu\TableFactory as MenuTableFactory;
use Database\Factories\UserPermissionFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Disable foreign key constraints to avoid constraint violations while truncating
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
        DB::table('tables')->truncate();
        DB::table('lounges')->truncate();
        DB::table('menu_categories')->truncate();
        DB::table('menu_items')->truncate();


        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();

        User::factory(5)->create();
        Employee::factory(10)->create();
        Client::factory(10)->create();
        Supplier::factory(10)->create();
        Brand::factory(5)->create();
        Supply::factory(10)->create();
        InventoryMovementDetail::factory(10)->create();

        MenuCategory::factory(4)->create()->each(function ($category) {
            $qty = rand(1, 5);
            MenuItem::factory($qty)->create(['category_id' => $category->id]);
        });

        $roles = Role::factory(2)->create();
        $permissions = Permission::factory(6)->create();

        $roles->each(function ($role) use ($permissions) {
            $role->permissions()->attach(
                $permissions->random(rand(1, 2))->pluck('id')->toArray()
            );
        });

        $lounges = Lounge::factory()->count(3)->create();

        foreach ($lounges as $lounge) {
            for ($i = 0; $i < 10; $i++) {
                MenuTable::create((new MenuTableFactory())->newWithCode($lounge->id, $i));
            }
        }
        
    }
}
