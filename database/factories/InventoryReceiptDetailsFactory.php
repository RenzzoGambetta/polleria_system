<?php

namespace Database\Factories;

use App\Models\InventoryReceipt;
use App\Models\Supply;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryReceiptDetails>
 */
class InventoryReceiptDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'receipt_id' => InventoryReceipt::factory(),
            'supply_id' => Supply::factory(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'discount' => $this->faker->randomFloat(2, 0, 50),
            'quantity' => $this->faker->numberBetween(1, 100),
            'total_amount' => function (array $attributes) {
                return ($attributes['price'] - $attributes['discount']) * $attributes['quantity'];
            },
            'note' => $this->faker->optional()->sentence(10),
        ];
    }
}
