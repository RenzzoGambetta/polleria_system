<?php

namespace Database\Factories\Inventory;

use App\Models\InventoryIssue;
use App\Models\InventoryReceipt;
use App\Models\Supply;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\inventory\InventoryMovementDetail>
 */
class InventoryMovementDetailFactory extends Factory
{
    public function definition(): array
    {
        return [
            'receipt_id' => InventoryReceipt::factory(),
            'issue_id' => InventoryIssue::factory(),
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

    public function receipt(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'receipt_id' => InventoryReceipt::factory(),
                'issue_id' => null,
            ];
        });
    }

    public function issue(): self
    {
        return $this->state(function (array $attributes) {
            return [
                'receipt_id' => null,
                'issue_id' => InventoryIssue::factory(),
            ];
        });
    }
}
