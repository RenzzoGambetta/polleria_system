<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'document_type_id' => $this->faker->numberBetween(1, 2),
            'document_number' => $this->faker->unique()->numerify('########'),
            'name' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'company_name' => null,
            'birthdate' => $this->faker->date(),
            'gender' => $this->faker->boolean,
            'phone' => $this->faker->numerify('##########'),
            'email' => $this->faker->unique()->safeEmail,
        ];
    }
}
