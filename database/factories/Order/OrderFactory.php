<?php

namespace Database\Factories\Order;

use App\Models\Client;
use App\Models\menu\Table;
use App\Models\order\CashierSession;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'table_id' => $this->faker->numberBetween(1, 10),
            'cashier_session_id' => CashierSession::factory(),
            'waiter_id' => User::factory(),
            'voucher_id' => $this->faker->numberBetween(1, 2),
            'voucher_serie' => $this->faker->text(4),
            'correlative_number' => $this->faker->numerify('######'),
            'issuance_date' => $this->faker->date(),
            'expiration_date' => $this->faker->optional()->date(),
            'payment_type' => $this->faker->randomElement(['contado', 'credito']),
            'payment_method' => $this->faker->randomElement(['efectivo', 'debito', 'credito', 'yape', 'plin']),
            'total_amount' => $this->faker->decimal(8, 2),
            'status' => $this->faker->randomElement(['pendiente', 'preparacion', 'terminado', 'en espera', 'pagado', 'completado', 'cancelado', 'reembolsado']),
            'is_delibery' => $this->faker->boolean(),
            'commentary' => $this->faker->optional()->text(255),
        ];
    }
}
