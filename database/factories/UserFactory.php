<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => '$2y$10$5Qz0XGPkDLpS0YvfQCdDCOT/y9oAibb80y.JnxdRZZUpRwZb5jw2O', // password
            'api_token' => Str::random(80),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the user is suspended.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function johnDoe()
    {
        return $this->state(function (array $attributes) {
            return [
                'name' => 'Jonny Doe',
                'email' => 'test@mail',
                'password' => '$2y$10$5Qz0XGPkDLpS0YvfQCdDCOT/y9oAibb80y.JnxdRZZUpRwZb5jw2O',
                'is_admin' => true,
            ];
        });
    }
}
