<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Unemployed;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CommentsTableSeeder extends Seeder
{
    public function run(): void
    {
        $comments = [
            [
                'unemployed_id' => 2,
                'company_id' => 1,
                'content' => '¿Esta posición es remota?',
                'created_at' => Carbon::now()->subDays(2)
            ],
            [
                'unemployed_id' => 1,
                'company_id' => 1,
                'content' => 'Ofrecemos modalidad híbrida',
                'created_at' => Carbon::now()->subDay()
            ]
        ];

        $prepared = [];
        $company = Company::first();
        $unemployed = Unemployed::first();
        $secondUnemployed = Unemployed::skip(1)->first();

        if ($company && $secondUnemployed) {
            $prepared[] = [
                'unemployed_id' => $secondUnemployed->id,
                'company_id' => $company->id,
                'content' => $comments[0]['content'],
                'created_at' => $comments[0]['created_at'],
                'updated_at' => now(),
            ];
        }
        if ($company && $unemployed) {
            $prepared[] = [
                'unemployed_id' => $unemployed->id,
                'company_id' => $company->id,
                'content' => $comments[1]['content'],
                'created_at' => $comments[1]['created_at'],
                'updated_at' => now(),
            ];
        }

        DB::table('comments')->insertOrIgnore($prepared);
    }
}