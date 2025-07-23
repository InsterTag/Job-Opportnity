<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JobOffer;
use Carbon\Carbon;

class JobOffersTableSeeder extends Seeder
{
    public function run(): void
    {
        $jobOffers = [
            [
                'company_id' => 1,
                'title' => 'Desarrollador Backend Laravel',
                'description' => 'Buscamos desarrollador con experiencia en Laravel',
                'salary' => 5000000.00,
                'location' => 'Bogotá',
                'geolocation' => '4.7110,-74.0721',
                'offer_type' => 'contract',
                'created_at' => Carbon::now()->subDays(5)
            ],
            [
                'company_id' => 2,
                'title' => 'Diseñador UI/UX',
                'description' => 'Oportunidad para diseñador creativo',
                'salary' => 4500000.00,
                'location' => 'Medellín',
                'geolocation' => '6.2442,-75.5812',
                'offer_type' => 'classified',
                'created_at' => Carbon::now()->subDays(2)
            ],
            [
                'company_id' => 3,
                'title' => 'Constructor Civil',
                'description' => 'Se busca constructor con experiencia en obras civiles',
                'salary' => 5000000.00,
                'location' => 'Bogotá',
                'geolocation' => '4.7110,-74.0721',
                'offer_type' => 'classified',
                'created_at' => Carbon::now()->subDays(5)
            ],
            [
                'company_id' => 4,
                'title' => 'Cocinero para restaurante',
                'description' => 'Oportunidad para cocinar en nuestras cocinas',
                'salary' => 4500000.00,
                'location' => 'Popayan',
                'geolocation' => '6.2442,-75.5812',
                'offer_type' => 'contract',
                'created_at' => Carbon::now()->subDays(2)
            ]
        ];

        foreach ($jobOffers as $jobOffer) {
            JobOffer::create($jobOffer);
        }
    }
}