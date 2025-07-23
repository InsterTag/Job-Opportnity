<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Tecnología', 'description' => 'Ofertas relacionadas con desarrollo de software y TI'],
            ['name' => 'Diseño', 'description' => 'Ofertas para diseñadores gráficos y creativos'],
            ['name' => 'Marketing', 'description' => 'Oportunidades en marketing digital y tradicional'],
            ['name' => 'Construcción', 'description' => 'Ofertas en el sector de la construcción y obras civiles'],
            ['name' => 'Gastronomía', 'description' => 'Oportunidades en restaurantes y servicios de comida'],
            ['name' => 'Administración', 'description' => 'Ofertas en gestión y administración de empresas'],
            ['name' => 'Salud', 'description' => 'Oportunidades en el sector salud y bienestar'],
            ['name' => 'Educación', 'description' => 'Ofertas en enseñanza y formación profesional']
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}