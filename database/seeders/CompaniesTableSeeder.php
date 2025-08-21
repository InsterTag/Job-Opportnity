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
                'name' => 'Tech Solutions SAS',
                'email' => 'contacto@techsolutions.com',
                'logo' => 'https://via.placeholder.com/100x100.png/0077dd?text=business+explicabo',
                'website' => 'https://techsolutions.com',
                'company_name' => 'Tech Solutions SAS',
                'description' => 'Empresa especializada en desarrollo de software'
            ],
            [
                'user_id' => 3,
                'name' => 'Diseño Creativo Ltda',
                'email' => 'info@disenocreativo.com',
                'logo' => 'https://via.placeholder.com/100x100.png/00bb99?text=business+sed',
                'website' => 'https://disenocreativo.com',
                'company_name' => 'Diseño Creativo Ltda',
                'description' => 'Agencia de diseño gráfico y marketing digital'
            ],
            [
                'user_id' => 5,
                'name' => 'Construcciones y Obras SA',
                'email' => 'contacto@construccionesobras.com',
                'logo' => 'https://via.placeholder.com/100x100.png/009944?text=business+officiis',
                'website' => 'https://construccionesobras.com',
                'company_name' => 'Construcciones y Obras SA',
                'description' => 'Empresa constructora con más de 20 años de experiencia'
            ],
            [
                'user_id' => 7,
                'name' => 'Restaurante Gourmet',
                'email' => 'info@restaurantegourmet.com',
                'logo' => 'https://via.placeholder.com/100x100.png/0088cc?text=business+gourmet',
                'website' => 'https://restaurantegourmet.com',
                'company_name' => 'Restaurante Gourmet',
                'description' => 'Restaurante de alta cocina con enfoque en ingredientes locales'
            ]
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}