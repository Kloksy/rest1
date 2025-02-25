<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserPreference;
use App\Models\Cuisine;
use App\Models\GeneralInfo;
use App\Models\EstablishmentType;
use Illuminate\Support\Facades\DB;

class UserPreferencesSeeder extends Seeder
{
    public function run()
    {
        $users = \App\Models\User::all();
        $cuisines = Cuisine::all();
        $generalInfo = GeneralInfo::all();
        $types = EstablishmentType::all();

        foreach ($users as $user) {
            // Создаем основные предпочтения пользователя
            UserPreference::create([
                'user_id' => $user->id,
                'price_category' => $this->randomPriceCategory(), // Случайная ценовая категория
            ]);

            // Добавляем любимые кухни (от 1 до 5 случайных)
            $preferredCuisines = $cuisines->random(rand(1, 5))->pluck('id');
            foreach ($preferredCuisines as $cuisineId) {
                DB::table('user_preferred_cuisines')->insert([
                    'user_id' => $user->id,
                    'cuisine_id' => $cuisineId,
                ]);
            }

            // Добавляем любимые услуги (от 1 до 5 случайных)
            $preferredGeneralInfo = $generalInfo->random(rand(1, 5))->pluck('id');
            foreach ($preferredGeneralInfo as $infoId) {
                DB::table('user_preferred_general_info')->insert([
                    'user_id' => $user->id,
                    'general_info_id' => $infoId,
                ]);
            }

            // Добавляем любимые типы заведений (от 1 до 3 случайных)
            $preferredTypes = $types->random(rand(1, 3))->pluck('id');
            foreach ($preferredTypes as $typeId) {
                DB::table('user_preferred_types')->insert([
                    'user_id' => $user->id,
                    'type_id' => $typeId,
                ]);
            }
        }
    }

    private function randomPriceCategory()
    {
        $categories = ['низкие', 'средние', 'выше среднего'];
        return $categories[array_rand($categories)];
    }
}
