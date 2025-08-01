<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class NotificacionFactory extends Factory
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
             'titulo' => $this->faker->sentence,
             'mensaje' => $this->faker->sentence,
             'leida' => false,
        ];
    }
}
