<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class supplierFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private static $incrementPersonId = 11;

    public function definition(): array
    {
        return [
            'person_id' => self::$incrementPersonId++,
            'address' => $this->faker->address,
        ];
    }
}
