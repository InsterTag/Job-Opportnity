<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorizablesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categorizables = [
            // Oferta 1 - Tecnología
            [
                'category_id' => 1,
                'categorizable_id' => 1,
                'categorizable_type' => 'App\Models\JobOffer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Oferta 2 - Diseño
            [
                'category_id' => 2,
                'categorizable_id' => 2,
                'categorizable_type' => 'App\Models\JobOffer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Oferta 3 - Administración y Construcción
            [
                'category_id' => 3,
                'categorizable_id' => 3,
                'categorizable_type' => 'App\Models\JobOffer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'category_id' => 4,
                'categorizable_id' => 3,
                'categorizable_type' => 'App\Models\JobOffer',
                'created_at' => now(),
                'updated_at' => now()
            ],
            
            // Oferta 4 - Gastronomía
            [
                'category_id' => 5,
                'categorizable_id' => 4,
                'categorizable_type' => 'App\Models\JobOffer',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        DB::table('categorizables')->insert($categorizables);
    }
}