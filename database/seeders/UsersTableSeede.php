<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class User extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        UserFactory::factory()->count(10)->create();
        $users = [
            [
                'name' => 'Empresa 1',
                'email' => 'empresa1@example.com',
                'password' => Hash::make('password123'),
                'type' => 'company',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Candidato 1',
                'email' => 'candidato1@example.com',
                'password' => Hash::make('password123'),
                'type' => 'unemployed',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Empresa 2',
                'email' => 'empresa2@example.com',
                'password' => Hash::make('password123'),
                'type' => 'company',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Candidato 2',
                'email' => 'candidato2@example.com',
                'password' => Hash::make('password123'),
                'type' => 'unemployed',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Empresa 3',
                'email' => 'empresa3@example.com',
                'password' => Hash::make('password123'),
                'type' => 'company',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Candidato 3',
                'email' => 'candidato3@example.com',
                'password' => Hash::make('password123'),
                'type' => 'unemployed',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Empresa 4',
                'email' => 'empresa4@example.com',
                'password' => Hash::make('password123'),
                'type' => 'company',
                'email_verified_at' => now()
            ],
            [
                'name' => 'Candidato 4',
                'email' => 'candidato4@example.com',
                'password' => Hash::make('password123'),
                'type' => 'unemployed',
                'email_verified_at' => now()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
