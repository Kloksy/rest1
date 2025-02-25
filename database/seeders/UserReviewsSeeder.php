<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserReview;
use App\Models\YandexReview;
use App\Models\User;
use App\Models\Establishment;
use Faker\Factory as Faker;

class UserReviewsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ru_RU');
        $users = User::all();
        $establishments = Establishment::all();

        foreach ($users as $user) {
            // Выбираем от 5 до 10 случайных заведений для отзыва
            $selectedEstablishments = $establishments->random(rand(5, 10));

            foreach ($selectedEstablishments as $establishment) {
                // Находим все yandex_reviews для данного заведения
                $yandexReviews = YandexReview::where('establishment_id', $establishment->id)->get();

                if ($yandexReviews->isNotEmpty()) {
                    // Выбираем случайный отзыв из yandex_reviews
                    $randomYandexReview = $yandexReviews->random();

                    // Создаем user_review на основе выбранного yandex_review
                    UserReview::create([
                        'user_id' => $user->id,
                        'establishment_id' => $establishment->id,
                        'rating' => $randomYandexReview->rating, // Используем рейтинг из yandex_review
                        'content' => $randomYandexReview->content, // Адаптируем текст отзыва
                        'created_at' => $randomYandexReview->created_at, // Используем дату создания yandex_review
                    ]);
                } else {
                    // Если нет yandex_reviews для заведения, создаем фейковый отзыв
                    $faker = \Faker\Factory::create('ru_RU');
                    $rating = $faker->numberBetween(1, 5);
                    UserReview::create([
                        'user_id' => $user->id,
                        'establishment_id' => $establishment->id,
                        'rating' => $rating, // Случайный рейтинг
                        'content' => $this->generateFakeReview($establishment, $rating), // Генерируем фейковый отзыв
                        'created_at' => $faker->dateTimeThisYear, // Случайная дата создания
                    ]);
                }
            }
        }

    }

    private function generateFakeReview($establishment, $rating)
    {
        // Генерация фейкового отзыва на основе характеристик заведения
        $cuisines = implode(', ', $establishment->cuisines()->pluck('name')->toArray());
        $generalInfo = implode(', ', $establishment->generalInfos()->pluck('name')->toArray());

        $faker = \Faker\Factory::create('ru_RU');

        if ($rating > 3) {
            // Позитивный отзыв
            return "Отличное место! {$cuisines} блюда были очень вкусными, а {$generalInfo} порадовали.";
        } else {
            // Негативный отзыв
            return "К сожалению, посещение не оправдало ожиданий. {$cuisines} блюда были не слишком свежими, а {$generalInfo} не впечатлили.";
        }
    }
}
