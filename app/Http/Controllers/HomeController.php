<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\User;
use App\Models\UserPreference;
use App\Models\EstablishmentType;
use App\Models\Cuisine;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        #$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Получить все типы заведений для формы
        $establishmentTypes = EstablishmentType::all();

        // Получить все типы кухонь для формы
        $cuisines = Cuisine::all();

        // Получить топ-5 популярных заведений
        $popularEstablishments = Establishment::orderByDesc('rating')->take(5)->get();

        // Получить рекомендации для пользователя
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $recommendations = $this->calculateHybridRecommendations($userId);
        } else {
            // Для неавторизованных пользователей показываем заведения поблизости
            $recommendations = Establishment::inRandomOrder()->take(5)->get();
        }

        return view('home', [
            'establishmentTypes' => $establishmentTypes,
            'cuisines' => $cuisines,
            'popularEstablishments' => $popularEstablishments,
            'recommendations' => $recommendations,
        ]);
    }

    public function calculateHybridRecommendations($userId)
    {
        // Шаг 1: Получить предпочтения пользователя
        $userPreferences = UserPreference::where('user_id', $userId)->first();
        if (!$userPreferences) {
            return []; // Если предпочтения не установлены, вернуть пустой массив
        }

        // Шаг 2: Получить текущее местоположение пользователя
        $userLocation = User::where('id', $userId)->first();

        // Шаг 3: Найти все заведения, соответствующие предпочтениям пользователя
        $preferredCuisines = $userPreferences->cuisines()->pluck('id'); // Получить любимые кухни
        $preferredGeneralInfo = $userPreferences->generalInfos()->pluck('id'); // Получить любимые услуги
        $preferredTypes = $userPreferences->types()->pluck('id'); // Получить любимые типы заведений

        // Фильтрация заведений по предпочтениям
        $establishments = Establishment::where(function ($query) use ($userPreferences) {
            if ($userPreferences->price_category) {
                $query->where('price_category', $userPreferences->price_category);
            }
        })
        ->whereHas('cuisines', function ($q) use ($preferredCuisines) {
            if (!empty($preferredCuisines)) {
                $q->whereIn('id', $preferredCuisines);
            }
        })
        ->whereHas('generalInfo', function ($q) use ($preferredGeneralInfo) {
            if (!empty($preferredGeneralInfo)) {
                $q->whereIn('id', $preferredGeneralInfo);
            }
        })
        ->whereHas('type', function ($q) use ($preferredTypes) {
            if (!empty($preferredTypes)) {
                $q->whereIn('id', $preferredTypes);
            }
        })
        ->get();

        // Массив для хранения рекомендаций
        $recommendations = [];

        // Шаг 4: Вычисление content_score для каждого заведения
        foreach ($establishments as $establishment) {
            $contentScore = 0;

            // Учет расстояния до текущего местоположения пользователя
            if ($userLocation) {
                $distance = $this->calculateDistance(
                    $userLocation->latitude,
                    $userLocation->longitude,
                    $establishment->latitude,
                    $establishment->longitude
                );
                $contentScore += 1 / (1 + $distance); // Чем ближе заведение, тем выше score
            }

            // Учет рейтинга заведения
            $contentScore += $establishment->rating / 5;

            // Процент совпадений по кухням
            $commonCuisines = array_intersect(
                $establishment->cuisines()->pluck('id')->toArray(),
                $preferredCuisines
            );
            $cuisineMatchPercentage = count($preferredCuisines) > 0
                ? count($commonCuisines) / count($preferredCuisines)
                : 0;
            $contentScore += $cuisineMatchPercentage * 0.4; // Кухни имеют вес 0.4

            // Процент совпадений по дополнительным услугам
            $commonGeneralInfo = array_intersect(
                $establishment->generalInfos()->pluck('id')->toArray(),
                $preferredGeneralInfo
            );
            $generalInfoMatchPercentage = count($preferredGeneralInfo) > 0
                ? count($commonGeneralInfo) / count($preferredGeneralInfo)
                : 0;
            $contentScore += $generalInfoMatchPercentage * 0.3; // Услуги имеют вес 0.3

            // Процент совпадений по типам заведений
            $commonTypes = array_intersect(
                $establishment->type->pluck('id')->toArray(),
                $preferredTypes
            );
            $typeMatchPercentage = count($preferredTypes) > 0
                ? count($commonTypes) / count($preferredTypes)
                : 0;
            $contentScore += $typeMatchPercentage * 0.3; // Типы заведений имеют вес 0.3

            // Сохраняем content_score для заведения
            $recommendations[$establishment->id]['content_score'] = $contentScore;
            $recommendations[$establishment->id]['establishment'] = $establishment;
        }

        // Шаг 5: Вычисление social_score на основе коллаборативной фильтрации
        $similarUsers = $this->findSimilarUsers($userId);

        foreach ($similarUsers as $similarUser) {
            // Получаем взаимодействия пользователя только с уже отобранными заведениями
            $userInteractions = UserInteraction::where('user_id', $similarUser->id)
                ->whereIn('establishment_id', array_keys($recommendations))
                ->with('review') // Загружаем связанные отзывы
                ->get();

            foreach ($userInteractions as $interaction) {
                if (isset($recommendations[$interaction->establishment_id])) {
                    // Нормализация social_score: усреднить оценки между всеми похожими пользователями
                    $recommendations[$interaction->establishment_id]['social_score'] += ($interaction->review->rating / 5) / count($similarUsers);
                }
            }
        }

        // Шаг 6: Объединение content_score и social_score
        foreach ($recommendations as $establishmentId => &$recommendation) {
            $recommendation['total_score'] = $recommendation['content_score'] * 0.7 + $recommendation['social_score'] * 0.3;
        }

        // Шаг 7: Сортировка заведений по total_score
        uasort($recommendations, function ($a, $b) {
            return $b['total_score'] <=> $a['total_score'];
        });

        // Шаг 8: Возвращаем топ-рекомендации
        return array_slice($recommendations, 0, 10, true); // Вернуть первые 10 заведений
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371;

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            cos(deg2rad($lat1)) * cos(deg2rad($lat2)) *
            sin($dLon / 2) * sin($dLon / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        return $earthRadius * $c;
    }

    private function findSimilarUsers($userId)
    {
        // Шаг 1: Получить явные предпочтения целевого пользователя
        $targetUserPreferences = UserPreference::where('user_id', $userId)->first();
        if (!$targetUserPreferences) {
            return []; // Если предпочтения не установлены, вернуть пустой массив
        }

        // Получить любимые кухни, дополнительные услуги и типы заведений
        $targetCuisines = $targetUserPreferences->cuisines()->pluck('id')->toArray(); // Массив ID любимых кухонь
        $targetGeneralInfo = $targetUserPreferences->generalInfos()->pluck('id')->toArray(); // Массив ID любимых услуг
        $targetTypes = $targetUserPreferences->types()->pluck('id')->toArray(); // Массив ID любимых типов заведений

        // Шаг 2: Найти пользователей с похожими предпочтениями
        $similarUsers = UserPreference::where(function ($query) use ($targetUserPreferences) {
            if ($targetUserPreferences->price_category) {
                $query->where('price_category', $targetUserPreferences->price_category);
            }
        })
        ->whereHas('cuisines', function ($q) use ($targetCuisines) {
            if (!empty($targetCuisines)) {
                $q->whereIn('id', $targetCuisines);
            }
        })
        ->whereHas('generalInfo', function ($q) use ($targetGeneralInfo) {
            if (!empty($targetGeneralInfo)) {
                $q->whereIn('id', $targetGeneralInfo);
            }
        })
        ->whereHas('types', function ($q) use ($targetTypes) {
            if (!empty($targetTypes)) {
                $q->whereIn('id', $targetTypes);
            }
        })
        ->where('user_id', '!=', $userId) // Исключить самого пользователя
        ->with('user') // Подгрузить связанных пользователей
        ->get();

        // Шаг 3: Рассчитать "степень похожести" для каждого найденного пользователя
        $similarityScores = [];
        foreach ($similarUsers as $similarUserPreference) {
            $score = 0;

            // Сравнение любимых кухонь
            $commonCuisines = array_intersect(
                $similarUserPreference->cuisines()->pluck('id')->toArray(),
                $targetCuisines
            );
            $cuisineMatchPercentage = count($targetCuisines) > 0
                ? count($commonCuisines) / count($targetCuisines)
                : 0;
            $score += $cuisineMatchPercentage * 0.4; // Кухни имеют вес 0.4

            // Сравнение любимых дополнительных услуг
            $commonGeneralInfo = array_intersect(
                $similarUserPreference->generalInfos()->pluck('id')->toArray(),
                $targetGeneralInfo
            );
            $generalInfoMatchPercentage = count($targetGeneralInfo) > 0
                ? count($commonGeneralInfo) / count($targetGeneralInfo)
                : 0;
            $score += $generalInfoMatchPercentage * 0.2; // Дополнительные услуги имеют вес 0.2

            // Сравнение любимых типов заведений
            $commonTypes = array_intersect(
                $similarUserPreference->types()->pluck('id')->toArray(),
                $targetTypes
            );
            $typeMatchPercentage = count($targetTypes) > 0
                ? count($commonTypes) / count($targetTypes)
                : 0;
            $score += $typeMatchPercentage * 0.4; // Типы заведений имеют вес 0.4

            // Сохранить результат
            $similarityScores[$similarUserPreference->user_id] = [
                'user' => $similarUserPreference->user,
                'score' => $score,
            ];
        }

        // Шаг 4: Отсортировать пользователей по score и вернуть топ-похожих
        uasort($similarityScores, function ($a, $b) {
            return $b['score'] <=> $a['score']; // Сортировка по убыванию score
        });

        // Вернуть только пользователей (без score)
        return array_column(array_slice($similarityScores, 0, 10, true), 'user'); // Вернуть первые 10 похожих пользователей
    }
}
