<?php

namespace Database\Factories\Various;

use App\Models\various\VoucherSerie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\various\VoucherSerie>
 */
class VoucherSerieFactory extends Factory
{
    protected $model = VoucherSerie::class;

    public function definition(): array
    {
        static $index = 0;

        // Valores por defecto en la base de datos
        $voucherSeries = [
            ['voucher_type_id' => 1, 'serie_number' => 'B001', 'last_correlative_number' => 0],
            ['voucher_type_id' => 2, 'serie_number' => 'F001', 'last_correlative_number' => 0],
            ['voucher_type_id' => 3, 'serie_number' => 'NV01', 'last_correlative_number' => 0],
            ['voucher_type_id' => 1, 'serie_number' => 'B002', 'last_correlative_number' => 0],
            ['voucher_type_id' => 2, 'serie_number' => 'F002', 'last_correlative_number' => 0],
        ];

        $vs = $voucherSeries[$index];
        $index++;

        return [
            'voucher_type_id' => $vs['voucher_type_id'],
            'serie_number' => $vs['serie_number'],
            'last_correlative_number' => $vs['last_correlative_number'],
        ];
    }
}
