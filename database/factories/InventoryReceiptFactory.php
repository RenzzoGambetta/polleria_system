<?php

namespace Database\Factories;

use App\Models\finance\Voucher;
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
            'voucher_id' => Voucher::factory(),
            'supplier_id' => Supplier::factory(),
            'total_amount' => $this->faker->randomFloat(2, 1, 1000),
            'incoming_date' => $this->faker->date(),
            'commentary' => $this->faker->optional()->sentence(),
        ];
    }
}
