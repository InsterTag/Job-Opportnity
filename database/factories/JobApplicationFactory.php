<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JobApplication;
use App\Models\Unemployed;
use App\Models\JobOffer;

/**
 * @extends Factory<JobApplication>
 */
class JobApplicationFactory extends Factory
{
    protected $model = JobApplication::class;

    public function definition(): array
    {
        return [
            'unemployed_id' => Unemployed::factory(),
            'job_offer_id' => JobOffer::factory(),
            'message' => $this->faker->sentence,
            'status' => 'pending',
            'cv_path' => null,
        ];
    }
}
