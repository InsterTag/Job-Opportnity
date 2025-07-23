<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            [
                'user_id' => 1,
                'company_name' => 'Tech Solutions SAS',
                'description' => 'Empresa especializada en desarrollo de software'
            ],
            [
                'user_id' => 3,
                'company_name' => 'Diseño Creativo Ltda',
                'description' => 'Agencia de diseño gráfico y marketing digital'
            ]
            ,
            [
                'user_id' => 5,
                'company_name' => 'Construcciones y Obras SA',
                'description' => 'Empresa constructora con más de 20 años de experiencia'
            ],
            [
                'user_id' => 7,
                'company_name' => 'Restaurante Gourmet',
                'description' => 'Restaurante de alta cocina con enfoque en ingredientes locales'
            ]

        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}