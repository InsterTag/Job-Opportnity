<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobApplication;
use App\Models\Unemployed;
use App\Models\JobOffer;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class JobApplicationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $unemployed = Unemployed::first();
        $secondUnemployed = Unemployed::skip(1)->first();
        $jobOffer = JobOffer::first();
        $secondJobOffer = JobOffer::skip(1)->first();

        $applications = [];
        if ($unemployed && $jobOffer) {
            $applications[] = [
                'unemployed_id' => $unemployed->id,
                'job_offer_id' => $jobOffer->id,
                'message' => 'Estoy interesado en esta posición'
            ];
        }
        if ($secondUnemployed && $secondJobOffer) {
            $applications[] = [
                'unemployed_id' => $secondUnemployed->id,
                'job_offer_id' => $secondJobOffer->id,
                'message' => 'Mi experiencia coincide con los requisitos'
            ];
        }

        foreach ($applications as $application) {
            JobApplication::firstOrCreate([
                'unemployed_id' => $application['unemployed_id'],
                'job_offer_id' => $application['job_offer_id']
            ], $application);
        }
    }
}