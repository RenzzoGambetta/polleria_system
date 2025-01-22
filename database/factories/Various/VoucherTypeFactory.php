<?php

namespace Database\Factories\Various;

use App\Models\various\VoucherType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VoucherType>
 */
class VoucherTypeFactory extends Factory
{
    protected $model = VoucherType::class;

    public function definition(): array
    {
        static $index = 0;

        // Valores por defecto en la base de datos
        $voucherTypes = [
            ['code' => 'B1', 'name' => 'Boleta', 'abbreviation' => 'BL', 'voucher_name' => 'Boleta de venta electronica'],
            ['code' => 'F1', 'name' => 'Factura', 'abbreviation' => 'FT', 'voucher_name' => 'Factura electronica'],
            ['code' => 'NV1', 'name' => 'Nota de Venta', 'abbreviation' => 'NV', 'voucher_name' => 'Nota de venta'],
        ];

        $vt = $voucherTypes[$index];
        $index++;

        return [
            'code' => $vt['code'],
            'name' => $vt['name'],
            'abbreviation' => $vt['abbreviation'],
            'voucher_name' => $vt['voucher_name'],
        ];
    }
}
