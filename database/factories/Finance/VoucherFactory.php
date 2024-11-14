<?php

namespace Database\Factories\Finance;

use App\Models\finance\Voucher;
use App\Models\various\VoucherSerie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\finance\Voucher>
 */
class VoucherFactory extends Factory
{
    

    public function definition(): array
    {
        $voucherSerie = VoucherSerie::inRandomOrder()->first();
        $correlativeNumber = $voucherSerie->last_correlative_number + 1;

        return [
            'voucher_serie_id' => $voucherSerie->id,
            'correlative_number' => $correlativeNumber,
            'issuance_date' => $this->faker->date(),
            'expiration_date' => $this->faker->date(),
            'total_amount' => $this->faker->randomFloat(2, 10, 1000),
            'payment_type' => $this->faker->randomElement(['contado', 'credito']),
            'payment_method_id' => $this->faker->numberBetween(1, 5),
            'commentary' => $this->faker->optional()->sentence(),
        ];
    }

    public function configure(): self
    {
        return $this->afterCreating(function (Voucher $voucher) {
            $voucherSerie = $voucher->voucherSerie;
            $voucherSerie->last_correlative_number = $voucher->correlative_number;
            $voucherSerie->save();
        });
    }
}
