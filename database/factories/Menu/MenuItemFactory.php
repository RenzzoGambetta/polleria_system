<?php

namespace Database\Factories\Menu;

use App\Models\menu\MenuCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\menu\MenuItems>
 */
class MenuItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'category_id' => MenuCategory::factory(),
            'name' => $this->faker->word(),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'is_combo' => $this->faker->boolean(),
            'display_order' => $this->faker->numberBetween(1, 10),
        ];
    }
}
