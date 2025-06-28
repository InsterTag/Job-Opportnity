<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TrainingUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainingUsers = [
            ['unemployed_id' => 1, 'training_id' => 1],
            ['unemployed_id' => 2, 'training_id' => 2],
            ['unemployed_id' => 3, 'training_id' => 3],
            ['unemployed_id' => 4, 'training_id' => 4]

        ];

        DB::table('training_users')->insert($trainingUsers);
    }
}
