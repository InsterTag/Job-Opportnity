<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\message>
 */
class messageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sender_id' => \App\Models\User::factory(),
            'receiver_id' => \App\Models\User::factory(),
            'content' => $this->faker->realText(200),
            'is_read' => $this->faker->boolean(30), // 30% chance of being true
            'created_at' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
