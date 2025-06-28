<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\JobOffer>
 */
class JobOfferFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
       'title' => $this->faker->jobTitle,
       'description' => $this->faker->paragraph,
       'company_id' => \App\Models\Company::factory(),
       'status' => 'active',
        ];
    }
}
