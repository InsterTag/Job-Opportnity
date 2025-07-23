<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Comment;
use Carbon\Carbon;

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

        foreach ($comments as $comment) {
            Comment::create($comment);
        }
    }
}