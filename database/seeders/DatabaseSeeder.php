<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call(RolesTableSeeder::class); // Добавляем роли
        $this->call(UserTableSeeder::class); // Добавляем пользователей
        $this->call(UserPreferencesSeeder::class); // Добавляем предпочтения пользователей
        $this->call(UserReviewsSeeder::class); // Добавляем отзывы пользователей
        $this->call(UserInteractionsSeeder::class); // Добавляем взаимодействия пользователей
    }
}
