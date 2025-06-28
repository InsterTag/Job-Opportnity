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
        'dni' => $this->faker->unique()->dni,
        'birth_date' => $this->faker->date(),
        'education_level' => $this->faker->randomElement(['Secundaria', 'Universitario']),
        'unemployment_duration' => $this->faker->numberBetween(1, 12),
        ];
    }
}
