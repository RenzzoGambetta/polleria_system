<?php

namespace Database\Factories;

use App\Models\Employee;
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

    private static $incrementPersonId = 1;

    public function definition(): array
    {
        static $userIds = [4, 5];
        static $counter = 0;

        return [
            'user_id' => $counter < 2 ? $userIds[$counter++] : null,
            'person_id' => self::$incrementPersonId++,
            'address' => $this->faker->address,
            'nationality' => $this->faker->randomElement(['peruano', 'venezolano', 'chileno']),
        ];
    }
}
