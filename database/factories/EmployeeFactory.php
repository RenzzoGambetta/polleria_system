<?php

namespace Database\Factories;

use App\Models\Employee;
use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
    */
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'person_id' => Person::factory(),
            'address' => $this->faker->address,
            'nationality' => $this->faker->randomElement(['peruano', 'venezolano', 'chileno']),
        ];
    }
}
