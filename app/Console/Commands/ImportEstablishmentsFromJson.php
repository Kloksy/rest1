<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\Establishment;
use App\Models\Cuisine;
use App\Models\GeneralInfo;
use App\Models\Contact;
use App\Models\WorkingHour;
use App\Models\Photo;
use App\Models\EstablishmentType;

class ImportEstablishmentsFromJson extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:establishments {path : database/seeders/restaurants_data.json}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import establishments data from a JSON file into the database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $path = $this->argument('path');
    
        if (!file_exists($path)) {
            $this->error('File not found.');
            return 1;
        }
    
        $content = file_get_contents($path);
        $data = json_decode($content, true);
    
        if (json_last_error() !== JSON_ERROR_NONE) {
            $this->error('Invalid JSON file.');
            return 1;
        }
    
        foreach ($data as $key => $item) { // Используем $key как ID
            $item['id'] = $key; // Добавляем ключ как поле 'id' в массив $item
            $this->importEstablishment($item);
        }
    
        $this->info('Data imported successfully.');
        return 0;
    }

    private function importEstablishment($item)
    {
        // Создаем тип заведения
        $type = EstablishmentType::firstOrCreate(['name' => $item['type']]);

        // Обработка reviews_count
        $reviewsCount = $this->parseReviewsCount($item['reviews_count']);

        // Создаем само заведение
        $establishment = Establishment::create(
            [
            'id' => $item['id'],
            'name' => $item['name'],
            'type_id' => $type->id,
            'average_bill' => $item['average_bill'] ?? null, 
            'price_category' => $item['price_category'] ?? null, 
            'latitude' => explode(',', $item['coordinates'])[1] ?? null,
            'longitude' => explode(',', $item['coordinates'])[0] ?? null,
            'address' => $item['address'],
            'rating' => $this->parseRating($item['rating'] ?? 1),
            'reviews_count' => $reviewsCount, // Используем обработанное значение
            'logo_url' => $item['logo'] ?? null,
            ]
        );

        // Добавляем кухни
        if (isset($item['cuisine'])) {
            foreach ($item['cuisine'] as $cuisineName) {
                $cuisine = Cuisine::firstOrCreate(['name' => $cuisineName]);
                $establishment->cuisines()->attach($cuisine->id);
            }
        }

        // Добавляем общую информацию
        if (isset($item['general_info'])) {
            foreach ($item['general_info'] as $infoName) {
                $info = GeneralInfo::firstOrCreate(['name' => $infoName]);
                $establishment->generalInfos()->attach($info->id);
            }
        }

        // Добавляем контакты
        if (isset($item['contacts'])) {
            foreach ($item['contacts'] as $type => $value) {
                Contact::create([
                    'establishment_id' => $establishment->id,
                    'type' => $type,
                    'value' => $value,
                ]);
            }
        }

        // Добавляем график работы
        if (isset($item['working_hours'])) {
            foreach ($item['working_hours'] as $day => $hours) {
                WorkingHour::create([
                    'establishment_id' => $establishment->id,
                    'day' => $day,
                    'hours' => $hours,
                ]);
            }
        }

        // Добавляем фотографии
        if (isset($item['photos'])) {
            foreach ($item['photos'] as $photoUrl) {
                Photo::create([
                    'establishment_id' => $establishment->id,
                    'url' => $photoUrl,
                ]);
            }
        }
    }
    
    // Метод для обработки reviews_count
    private function parseReviewsCount($reviewsCount)
    {
        if ($reviewsCount === 'Ещё нет отзывов') {
            return 0; // Устанавливаем значение по умолчанию
        }

        // Удаляем все символы, кроме цифр
        $numericValue = preg_replace('/[^0-9]/', '', $reviewsCount);

        // Возвращаем числовое значение или 0, если строка пустая
        return $numericValue !== '' ? (int)$numericValue : 0;
    }

    private function parseRating($rating)
    {
        if (empty($rating)) {
            return null; // Если рейтинг пустой, возвращаем null
        }

        // Заменяем запятую на точку и преобразуем в float
        $numericValue = str_replace(',', '.', $rating);

        // Проверяем, является ли значение числом
        return is_numeric($numericValue) ? (float)$numericValue : null;
    }

}
