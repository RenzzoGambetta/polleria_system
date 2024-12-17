<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        static $index = 0;
        $users = [
            ['username' => 'admin', 'role_id' => 1,'password' => 'admin123'],
            ['username' => 'cajero1', 'role_id' => 2,'password' => 'cajero123'],
            ['username' => 'cocinero1', 'role_id' => 3,'password' => 'cocinero123'],
            ['username' => 'mozo1', 'role_id' => 4,'password' => 'mozo123'],
            ['username' => 'mozo2', 'role_id' => 4,'password' => 'mozo123'],
        ];

        $u = $users[$index];
        $index++;

        return [
            'username' => $u['username'],
            'role_id' => $u['role_id'],
            'password' => $u['password'],
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
