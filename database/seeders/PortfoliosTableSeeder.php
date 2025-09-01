<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use App\Models\Unemployed;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PortfoliosTableSeeder extends Seeder
{
    public function run(): void
    {
        $portfolios = [
            [
                'unemployed_id' => 1,
                'title' => 'Sistema de Inventarios',
                'description' => 'Desarrollado con Laravel y Vue.js',
                'url_proyect' => 'https://github.com/usuario/inventario-app',
                'url_pdf' => 'https://drive.google.com/inventario.pdf',
                'created_at' => Carbon::now()->subMonths(2)
            ],
            [
                'unemployed_id' => 2,
                'title' => 'Rediseño de Marca',
                'description' => 'Identidad visual para cafetería',
                'url_proyect' => 'https://behance.net/cafe-redesign',
                'url_pdf' => 'https://drive.google.com/inventario1.pdf',
                'created_at' => Carbon::now()->subMonth()
            ]
            

            

        ];

        $prepared = [];
        $first = Unemployed::first();
        $second = Unemployed::skip(1)->first();

        if ($first) {
            $p = $portfolios[0];
            $p['unemployed_id'] = $first->id;
            $p['updated_at'] = now();
            $prepared[] = $p;
        }
        if ($second) {
            $p = $portfolios[1];
            $p['unemployed_id'] = $second->id;
            $p['updated_at'] = now();
            $prepared[] = $p;
        }

        DB::table('portfolios')->insertOrIgnore($prepared);
    }
}