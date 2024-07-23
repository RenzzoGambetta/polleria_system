<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Permission>
 */
class PermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $permissionNames = ['per1', 'per2', 'per3', 'per4'];

        return [
            'name' => $this->faker->unique()->randomElement($permissionNames),
            'category' => $this->faker->randomElement(['admin', 'ventas', 'pedidos', 'cocina']),
        ];
    }
}
