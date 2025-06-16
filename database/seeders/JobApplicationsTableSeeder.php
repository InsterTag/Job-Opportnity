<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobApplication;
use Carbon\Carbon;

class JobApplicationsTableSeeder extends Seeder
{
    public function run(): void
    {
        $applications = [
            [
                'unemployed_id' => 1,
                'job_offer_id' => 1,
                'message' => 'Estoy interesado en esta posición'
            ],
            [
                'unemployed_id' => 2,
                'job_offer_id' => 2,
                'message' => 'Mi experiencia coincide con los requisitos'
            ]
        ];

        foreach ($applications as $application) {
            JobApplication::create($application);
        }
    }
}