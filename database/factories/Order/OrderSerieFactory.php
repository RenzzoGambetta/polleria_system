<?php

namespace Database\Factories\Order;

use App\Models\order\OrderSerie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\order\OrderSerie>
 */
class OrderSerieFactory extends Factory
{
    protected $model = OrderSerie::class;

    public function definition(): array
    {
        static $index = 0;

        // Valores por defecto en la base de datos
        $orderSeries = [
            ['serie_number' => 'PD01', 'last_correlative_number' => 0],
            ['serie_number' => 'PD02', 'last_correlative_number' => 0],
        ];

        $os = $orderSeries[$index];
        $index++;

        return [
            'serie_number' => $os['serie_number'],
            'last_correlative_number' => $os['last_correlative_number'],
        ];
    }
}
