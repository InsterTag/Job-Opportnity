<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobAplication>
 */
class JobAplicationFactory extends Factory
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
            'job_offer_id' => \App\Models\JobOffer::factory(),
            'status' => $this->faker->randomElement(['pending', 'reviewed', 'accepted', 'rejected']),
        ];
    }
}
