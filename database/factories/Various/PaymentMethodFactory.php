<?php

namespace Database\Factories\Various;

use App\Models\various\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\various\PaymentMethod>
 */
class PaymentMethodFactory extends Factory
{
    protected $model = PaymentMethod::class;

    public function definition(): array
    {
        static $index = 0;

        //Valores por defecto en la base de datos
        $paymentMethods = [
            ['name' => 'efectivo', 'abbreviation' => 'efectivo'],
            ['name' => 'tarjeta de debito', 'abbreviation' => 'debito'],
            ['name' => 'tarjeta de credito', 'abbreviation' => 'credito'],
            ['name' => 'yape', 'abbreviation' => 'yape'],
            ['name' => 'plin', 'abbreviation' => 'plin'],
        ];

        $py = $paymentMethods[$index];
        $index++;

        return [
            'name' => $py['name'],
            'abbreviation' => $py['abbreviation'],
        ];
    }
}
