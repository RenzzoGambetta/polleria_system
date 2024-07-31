<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
use App\Models\Employee;
use App\Models\Role;
use App\Models\Permission;
use Database\Factories\UserPermissionFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();
        Person::factory(10)->create();
        Employee::factory(10)->create();
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
