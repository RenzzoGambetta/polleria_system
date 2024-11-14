<?php

namespace Database\Seeders;

use App\Models\menu\MenuCategory;
use App\Models\menu\MenuItem;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        $roles = Role::factory(4)->create();
        $permissions = Permission::factory(6)->create();

        $roles->each(function ($role) use ($permissions) {
            $role->permissions()->attach(
                $permissions->random(rand(1, 2))->pluck('id')->toArray()
            );
        });

        MenuCategory::factory(4)->create()->each(function ($category) {
            $qty = rand(1, 5);
            MenuItem::factory($qty)->create(['category_id' => $category->id]);
        });
    }
}
