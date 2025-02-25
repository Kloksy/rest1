<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\YandexReview;
use App\Models\Establishment;

use Carbon\Carbon;


class ImportYandexReviewsFromCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:yandex-reviews {path : database/seeders/reviews_output.csv}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Yandex reviews from a CSV file into the database.';

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

        $file = fopen($path, 'r');
        $header = fgetcsv($file); // Пропускаем заголовок

        while (($data = fgetcsv($file)) !== false) {
            $this->importReview($data, $header);
        }

        fclose($file);

        $this->info('Yandex reviews imported successfully.');
        return 0;
    }

    private function importReview($data, $header)
    {
        $placeId = $data[0]; // place_id
        $author = $data[1]; // author
        $rating = $data[2]; // rating
        $reviewText = $data[3]; // review_text
        $date = $data[4]; // date
    
        // Найти заведение по place_id
        $establishment = Establishment::where('id', $placeId)->first();
    
        if (!$establishment) {
            $this->warn("Establishment with ID {$placeId} not found. Skipping review.");
            return;
        }
    
        // Создать отзыв без updated_at
        YandexReview::create([
            'user_name' => $author,
            'establishment_id' => $establishment->id,
            'rating' => $this->parseRating($rating),
            'content' => $reviewText,
            'created_at' => $this->parseDate($date), // Используем только created_at
        ]);
    }

    private function parseRating($rating)
    {
        if (empty($rating)) {
            return null;
        }

        return (float)str_replace(',', '.', $rating);
    }

    private function parseDate($date)
    {
        if (empty($date)) {
            return null;
        }
    
        // Массив соответствий русских названий месяцев
        $months = [
            'января' => 'January',
            'февраля' => 'February',
            'марта' => 'March',
            'апреля' => 'April',
            'мая' => 'May',
            'июня' => 'June',
            'июля' => 'July',
            'августа' => 'August',
            'сентября' => 'September',
            'октября' => 'October',
            'ноября' => 'November',
            'декабря' => 'December',
        ];
    
        // Заменяем русские названия месяцев на английские
        foreach ($months as $ruMonth => $enMonth) {
            $date = str_replace($ruMonth, $enMonth, $date);
        }
    
        try {
            // Преобразуем дату из формата "j F Y" в "Y-m-d"
            return \Carbon\Carbon::createFromFormat('j F Y', $date, 'Europe/Moscow')
                                 ->format('Y-m-d');
        } catch (\Exception $e) {
            // Если формат неверный, используем текущую дату
            $this->warn("Invalid date format: {$date}. Using current date instead.");
            return now()->toDateString();
        }
    }
}
