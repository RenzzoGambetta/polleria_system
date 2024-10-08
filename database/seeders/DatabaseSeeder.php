<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Supplier;
use App\Models\Brand;
use App\Models\InventoryReceipt;
use App\Models\InventoryReceiptDetails;
use App\Models\Supply;
use App\Models\VoucherType;
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
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_permission')->truncate();
        DB::table('supplies')->truncate();
        DB::table('brands')->truncate();
        DB::table('suppliers')->truncate();
        DB::table('persons')->truncate();
        DB::table('voucher_types')->truncate();
        DB::table('inventory_receipts')->truncate();

        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();

        User::factory(5)->create();
        Person::factory(25)->create();
        Employee::factory(9)->create();
        // Supplier::factory(9)->create();
        Brand::factory(5)->create();
        Supply::factory(10)->create();
        VoucherType::factory()->createDefault();
        InventoryReceiptDetails::factory(10)->create();

        $roles = Role::factory(2)->create();
        $permissions = Permission::factory(6)->create();

        $roles->each(function ($role) use ($permissions) {
            $role->permissions()->attach(
                $permissions->random(rand(1, 2))->pluck('id')->toArray()
            );
        });
        /**
         * User::factory()->create([
         *   'name' => 'Test User',
         *   'email' => 'test@example.com',
         * ]);
         */
        
    }
}
