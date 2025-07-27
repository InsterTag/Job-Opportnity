<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            CompaniesTableSeeder::class,
            UnemployedsTableSeeder::class,
            JobOffersTableSeeder::class,
            CategoriesTableSeeder::class,
            CategorizablesTableSeeder::class,
            JobApplicationsTableSeeder::class,
            FavoriteOffersTableSeeder::class,
            MessagesTableSeeder::class,
            CommentsTableSeeder::class,
            PortfoliosTableSeeder::class,
            NotificationsTableSeeder::class,
            TrainingsTableSeeder::class,
            TrainingUsersTableSeeder::class,
        ]);
    }
}
