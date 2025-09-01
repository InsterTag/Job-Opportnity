<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Training;
use App\Models\Unemployed;

class TrainingUsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trainings = Training::all();
        $unemployeds = Unemployed::all();
        $prepared = [];

        foreach ($trainings as $index => $training) {
            $unemployed = $unemployeds->get($index);
            if (!$unemployed) continue;
            $prepared[] = ['unemployed_id' => $unemployed->id, 'training_id' => $training->id];
        }

        DB::table('training_users')->insertOrIgnore($prepared);
    }
}
