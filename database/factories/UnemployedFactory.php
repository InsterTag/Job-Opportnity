<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Unemployed>
 */
class UnemployedFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'profession' => $this->faker->jobTitle,
            'experience' => $this->faker->numberBetween(1, 10),
            'location' => $this->faker->city,
        ];
    }
}
