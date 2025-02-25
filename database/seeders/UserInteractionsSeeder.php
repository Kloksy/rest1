<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserInteraction;
use App\Models\UserReview;
use Faker\Factory as Faker;

class UserInteractionsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ru_RU');
        $userReviews = UserReview::all();

        foreach ($userReviews as $review) {
            // Создаем запись взаимодействия, используя данные из отзыва
            UserInteraction::create([
                'user_id' => $review->user_id,
                'establishment_id' => $review->establishment_id,
                'review_id' => $review->id, // Ссылка на review_id
                'viewed_at' => $review->created_at, // Используем дату создания отзыва как дату просмотра
            ]);
        }

    }
}
