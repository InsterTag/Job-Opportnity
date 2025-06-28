<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobOfferCategoryTableSeeder extends Seeder
{
    public function run(): void
    {
        $jobOfferCategories = [
            ['job_offer_id' => 1, 'category_id' => 1], // Tecnología
            ['job_offer_id' => 2, 'category_id' => 2], // Diseño
            ['job_offer_id' => 3, 'category_id' => 3], // Administración
            ['job_offer_id' => 3, 'category_id' => 4], // Construcción
            ['job_offer_id' => 4, 'category_id' => 5]  // Gastronomía
            
        ];

        DB::table('job_offer_category')->insert($jobOfferCategories);
    }
}