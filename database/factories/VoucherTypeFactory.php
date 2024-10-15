<?php

namespace Database\Factories;

use App\Models\VoucherType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VoucherType>
 */
class VoucherTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'code' => $this->faker->unique()->word(),
            'name' => $this->faker->word(),
            'abbreviation' => $this->faker->word(),
        ];
    }

    public function createDefault() : bool
    {
        return VoucherType::insert([
            ['code' => 'B1', 'name' => 'Boleta', 'abbreviation' => 'BL'],
            ['code' => 'F1', 'name' => 'Factura', 'abbreviation' => 'FT'],
        ]);
    }
}
