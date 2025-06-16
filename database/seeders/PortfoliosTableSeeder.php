<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Portfolio;
use Carbon\Carbon;

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

        foreach ($portfolios as $portfolio) {
            Portfolio::create($portfolio);
        }
    }
}