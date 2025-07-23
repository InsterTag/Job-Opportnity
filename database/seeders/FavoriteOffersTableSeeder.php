<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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

        DB::table('favorites')->insert($favorites); // Cambiado el nombre de la tabla
    }
}