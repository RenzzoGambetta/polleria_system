<?php

namespace Database\Factories;

use App\Models\Lounge;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lounge>
 */
class LoungeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $addresses = [
            'Direccion 1',
            'Direccion 2'
        ];

        $floor = Lounge::where('floor', 0)->count() >= 2 ? 1 : 0;

        return [
            'code' => strtoupper($this->faker->unique()->lexify('???')),
            'name' => $this->faker->company,
            'floor' => $floor,
            'address' => $addresses[$floor % 2],
        ];
    }
}
