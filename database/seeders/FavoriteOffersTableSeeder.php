<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
                'job_offer_id' => 2,
                'added_at' => Carbon::now()->subDays(5)
            ],
            [
                'unemployed_id' => 2,
                'job_offer_id' => 1,
                'added_at' => Carbon::now()->subDays(2)
            ]
        ];

        DB::table('favorite_offers')->insert($favorites);
    }
}