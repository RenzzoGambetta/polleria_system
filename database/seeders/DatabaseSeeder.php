<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Supplier;
use App\Models\Brand;
use App\Models\Supply;
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
        DB::table('persons')->truncate();
        DB::table('employees')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::table('role_permission')->truncate();
        DB::table('supplies')->truncate();
        DB::table('brands')->truncate();
        DB::table('suppliers')->truncate();

        // Re-enable foreign key constraints
        Schema::enableForeignKeyConstraints();

        User::factory(5)->create();
        Person::factory(20)->create();
        Employee::factory(10)->create();
        Supplier::factory(10)->create();
        Brand::factory(5)->create();
        Supply::factory(10)->create();

        $roles = Role::factory(4)->create();
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
