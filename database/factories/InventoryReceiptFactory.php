<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\VoucherType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryReceipt>
 */
class InventoryReceiptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'voucher_id' => $this->faker->numberBetween(1, 2),
            'voucher_serie' => $this->faker->lexify('????'),
            'correlative_number' => $this->faker->unique()->numerify('########'),
            'supplier_id' => Supplier::factory(),
            'issuance_date' => $this->faker->date(),
            'expiration_date' => $this->faker->date(),
            'total_amount' => $this->faker->randomFloat(2, 1, 1000),
            'payment_type' => $this->faker->randomElement(['contado', 'credito']),
            'commentary' => $this->faker->optional()->sentence(),
        ];
    }
}
