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
    protected static $increment = 1;

    public function definition(): array
    {

        return [
            'name' => 'permission' . self::$increment++,
            'category' => $this->faker->randomElement(['admin', 'ventas', 'pedidos', 'cocina']),
        ];
    }
}
