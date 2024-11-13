<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryIssue>
 */
class InventoryIssueFactory extends Factory
{
    public function definition(): array
    {
        return [
            'outgoing_date' => $this->faker->date(),
            'reason' => $this->faker->optional->sentence(),
        ];
    }
}
