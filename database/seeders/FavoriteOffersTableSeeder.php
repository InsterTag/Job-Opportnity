<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Unemployed;
use App\Models\JobOffer;

class FavoriteOffersTableSeeder extends Seeder
{
    public function run(): void
    {
        $favorites = [
            [
                'unemployed_id' => 1,
                'favoritable_id' => 2,  // Cambiado de job_offer_id
                'favoritable_type' => 'App\Models\JobOffer', // Nuevo campo
                'added_at' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'unemployed_id' => 2,
                'favoritable_id' => 1,  // Cambiado de job_offer_id
                'favoritable_type' => 'App\Models\JobOffer', // Nuevo campo
                'added_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];

        $prepared = [];
        $firstUnemployed = Unemployed::first();
        $secondUnemployed = Unemployed::skip(1)->first();
        $firstJobOffer = JobOffer::first();
        $secondJobOffer = JobOffer::skip(1)->first();

        if ($firstUnemployed && $secondJobOffer) {
            $prepared[] = [
                'unemployed_id' => $firstUnemployed->id,
                'favoritable_id' => $secondJobOffer->id,
                'favoritable_type' => 'App\\Models\\JobOffer',
                'added_at' => Carbon::now()->subDays(5),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }
        if ($secondUnemployed && $firstJobOffer) {
            $prepared[] = [
                'unemployed_id' => $secondUnemployed->id,
                'favoritable_id' => $firstJobOffer->id,
                'favoritable_type' => 'App\\Models\\JobOffer',
                'added_at' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ];
        }

        DB::table('favorites')->insertOrIgnore($prepared); // Evitar fallos por FK
    }
}