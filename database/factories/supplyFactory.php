<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class supplyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $units = ['und', 'kg', 'lt', 'bls', 'cja'];

        return [
            'brand_id' => Brand::factory(),
            'code' => $this->faker->unique()->ean8(),
            'name' => $this->faker->word,
            'is_stockable' => $this->faker->boolean,
            'stock' => $this->faker->randomNumber(2, false),
            'unit' => $this->faker->randomElement($units),
            'note' => $this->faker->text(250),
        ];
    }
}
