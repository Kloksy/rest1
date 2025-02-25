<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ru_RU');

        // Создаем N фейковых пользователей
        for ($i = 0; $i < 300; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Все пользователи имеют одинаковый пароль
                'email_verified_at' => now(),
                'role_id' => 3, // Присваиваем роль
                'latitude' => $faker->latitude(47.01, 49.05), // Диапазон широты для Донецка
                'longitude' => $faker->longitude(37.01, 38.85), // Диапазон долготы для Донецка
            ]);
        }

    }
}
