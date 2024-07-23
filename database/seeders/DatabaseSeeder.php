<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Person;
use App\Models\Employee;
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

        /**
         * User::factory()->create([
         *   'name' => 'Test User',
         *   'email' => 'test@example.com',
         * ]);
         */
        
    }
}
