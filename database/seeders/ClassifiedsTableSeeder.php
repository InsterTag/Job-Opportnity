<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClassifiedsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('classifieds')->truncate();

        $classifieds = [
            // 1. Oferta de empresa Tech Solutions SAS (relacionada con company_id 1)
            [
                'title' => 'Desarrollador Backend Laravel',
                'description' => 'Buscamos desarrollador con experiencia en Laravel para unirse a nuestro equipo. Se valorará conocimiento en APIs RESTful y MySQL.',
                'salary' => 3800000,
                'location' => 'Bogotá',
                'geolocation' => '4.710989,-74.072092',
                'company_id' => 1,
                'unemployed_id' => null,
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(5),
            ],

            // 2. Servicio de desempleado (Diseñador Gráfico - user_id 4)
            [
                'title' => 'Diseño de Identidad Corporativa',
                'description' => 'Creación de logos, manual de marca y material gráfico para tu empresa. Más de 5 años de experiencia trabajando con startups.',
                'salary' => 1200000,
                'location' => 'Medellín',
                'geolocation' => '6.244203,-75.581211',
                'company_id' => null,
                'unemployed_id' => 2,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(2),
            ],

            // 3. Oferta de empresa Construcciones y Obras SA (company_id 3)
            [
                'title' => 'Supervisor de Obra Civil',
                'description' => 'Se requiere ingeniero civil con mínimo 3 años de experiencia en supervisión de obras para proyecto en Cali.',
                'salary' => 4500000,
                'location' => 'Cali',
                'geolocation' => '3.451647,-76.531985',
                'company_id' => 3,
                'unemployed_id' => null,
                'created_at' => now()->subDays(15),
                'updated_at' => now()->subDays(3),
            ],

            // 4. Servicio de desempleado (Chef Profesional - user_id 8)
            [
                'title' => 'Catering para Eventos Empresariales',
                'description' => 'Chef con 10 años de experiencia ofrece servicio completo de catering para eventos corporativos. Menús personalizados.',
                'salary' => 2500000,
                'location' => 'Popayán',
                'geolocation' => '2.444814,-76.614739',
                'company_id' => null,
                'unemployed_id' => 4,
                'created_at' => now()->subDays(3),
                'updated_at' => now(),
            ],

            // 5. Oferta de empresa Restaurante Gourmet (company_id 4)
            [
                'title' => 'Jefe de Cocina',
                'description' => 'Buscamos chef con experiencia en cocina internacional para liderar nuestra cocina. Se requiere certificación en manipulación de alimentos.',
                'salary' => 4200000,
                'location' => 'Bogotá',
                'geolocation' => '4.647618,-74.108133',
                'company_id' => 4,
                'unemployed_id' => null,
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(10),
            ]
        ];

        DB::table('classifieds')->insert($classifieds);

        $this->command->info('¡Seeder de classifieds completado con 5 registros realistas!');
    }
}