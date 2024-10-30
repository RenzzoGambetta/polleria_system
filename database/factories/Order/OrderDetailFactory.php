<?php

namespace Database\Factories\Order;

use App\Models\menu\MenuItem;
use App\Models\order\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    public function definition()
    {
        return [
            'order_id' => Order::factory(),
            'item_id' => MenuItem::factory(),
            'price' => $this->faker->decimal(8, 2),
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_amount' => function (array $attributes) {
                return $attributes['price'] * $attributes['quantity'];
            },
            'status' => $this->faker->randomElement(['pendiente', 'preparacion', 'terminado', 'en espera', 'cancelado']),
            'is_delibery' => $this->faker->boolean(),
            'note' => $this->faker->optional()->text(100),
        ];
    }
}
