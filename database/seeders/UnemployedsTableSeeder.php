<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unemployed;
use App\Models\User;

class UnemployedsTableSeeder extends Seeder
{
    public function run(): void
    {
        $unemployeds = [
            [
                'user_id' => 2,
                'profession' => 'Desarrollador Web',
                'experience' => '3 años desarrollando aplicaciones con Laravel y Vue.js',
                'location' => 'Bogotá'
            ],
            [
                'user_id' => 4,
                'profession' => 'Diseñador Gráfico',
                'experience' => '5 años de experiencia en diseño de branding y UI/UX',
                'location' => 'Medellín'
            ]
            ,
            [
                'user_id' => 6,
                'profession' => 'Ingeniero Civil',
                'experience' => '7 años de experiencia en construcción de obras civiles',
                'location' => 'Cali'
            ],
            [
                'user_id' => 8,
                'profession' => 'Chef Profesional',
                'experience' => '10 años de experiencia en alta cocina y gestión de restaurantes',
                'location' => 'Popayán'
            ]



        ];

        foreach ($unemployeds as $index => $unemployed) {
            $expectedEmail = 'candidato' . ($index + 1) . '@example.com';
            $user = User::where('email', $expectedEmail)->first();
            if (!$user) {
                $user = User::where('type', 'unemployed')->skip($index)->first();
            }

            if (!$user) {
                continue;
            }

            $unemployed['user_id'] = $user->id;
            Unemployed::firstOrCreate(['user_id' => $user->id], $unemployed);
        }
    }
}