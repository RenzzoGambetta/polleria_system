<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rol>
 */
class RoleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $roleNames = ['admin', 'caja', 'cocinero', 'mozo'];

        return [
            'name' => $this->faker->unique()->randomElement($roleNames),
        ];

    }
}
