<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Establishment;
use App\Models\Cuisine;
use App\Models\GeneralInfo;
use App\Models\EstablishmentType;
use Livewire\WithPagination; 
use Carbon\Carbon;
use Stevebauman\Location\Facades\Location;

class EstablishmentSearch extends Component
{
    use WithPagination;

    protected $queryString = [
        'name' => ['except' => ''],
        'type_id' => ['except' => null],
        'cuisine_ids' => ['as' => 'cuisines'],
        'price_category' => ['except' => null],
        'general_info_ids' => ['as' => 'services'],
        'min_rating' => ['except' => 0],
        'max_rating' => ['except' => 5],
        'min_price' => ['except' => null],
        'max_price' => ['except' => null],
        'open_now' => ['except' => false],
        'sort_type' => ['except' => 'rating'],
        'sort_direction' => ['except' => 'desc'],
        'include_empty_ratings' => ['except' => false],
        'include_no_price' => ['except' => true],
    ];

    public $name = '';
    public $type_id = null;
    public $cuisine_ids = [];
    public $price_category = null;
    public $general_info_ids = [];
    public $sort_type = 'rating';
    public $sort_direction = 'desc';
    public $min_rating = 0;
    public $max_rating = 5;
    public $min_price = null;
    public $max_price = null;
    public $open_now = false;
    public $include_empty_ratings = false;
    public $include_no_price = true;
    public $userTimezone = null;
    public $userLocalTime;

    protected $listeners = ['timezoneUpdate'];

    public function render()
    {
        $currentTime = $this->getUserTime();
        // Фильтрация заведений на основе введенных данных
        $establishments = Establishment::query()
            ->when($this->name, fn($q) => $q->where('name', 'like', "%{$this->name}%"))
            ->when($this->type_id, fn($q) => $q->where('type_id', $this->type_id))
            ->when($this->cuisine_ids, fn($q) => $q->whereHas('cuisines', 
                fn($q) => $q->whereIn('id', $this->cuisine_ids)))
            ->when($this->price_category, fn($q) => $q->where('price_category', $this->price_category))
            ->when($this->general_info_ids, fn($q) => $q->whereHas('generalInfos', 
                fn($q) => $q->whereIn('id', $this->general_info_ids)))
            ->when($this->open_now, function($query) use ($currentTime) {
                $this->applyOpenNowFilter($query, $currentTime);
            })
            ->whereBetween('rating', [$this->min_rating, $this->max_rating])
            ->when($this->min_price || $this->max_price, function($query) {
                $query->where(function($query) {
                    $query->whereRaw("
                        (
                            COALESCE(
                                (regexp_match(split_part(average_bill, '–', 1), '\d+'))[1]::integer, 
                                0
                            ) >= ?
                            AND 
                            COALESCE(
                                (regexp_match(split_part(average_bill, '–', 2), '\d+'))[1]::integer, 
                                100000
                            ) <= ?
                        )".($this->include_no_price ? " OR average_bill IS NULL" : "")."
                    ", [$this->min_price, $this->max_price]);
                });
            })
            ->orderBy($this->sort_type, $this->sort_direction)
            ->with(['cuisines', 'generalInfos', 'workingHours'])
            ->paginate(9);

        // Подгружаем данные для фильтров
        $types = EstablishmentType::all();
        $cuisines = Cuisine::all();
        $generalInfos = GeneralInfo::all();

        return view('livewire.establishment-search', [
            'establishments' => $establishments,
            'types' => $types,
            'cuisines' => $cuisines,
            'generalInfos' => $generalInfos,
            'priceBounds' => $this->getPriceBounds(),
        ]);
    }

    public function updated($property)
    {
        if (in_array($property, ['min_rating', 'max_rating'])) {
            $this->validateRatingInputs();
            $this->applyFilters();
        }
    }

    public function applyFilters()
    {
        $this->gotoPage(1);
    }

    public function search()
    {        
        $this->gotoPage(1);
    }

    private function getUserTime()
    {
        return $this->userLocalTime ?? now($this->userTimezone);
    }

    private function applyOpenNowFilter($query, $currentTime)
    {
        $shortDay = $this->mapDayToShort($currentTime->format('D'));
        
        $query->whereHas('workingHours', function($q) use ($shortDay, $currentTime) {
            $q->where('day', $shortDay)
              ->where(function($q) use ($currentTime) {
                  $q->whereRaw("
                      (hours ~ '^\d{2}:\d{2}-\d{2}:\d{2}$'
                      AND split_part(hours, '-', 1)::time <= ?::time
                      AND split_part(hours, '-', 2)::time >= ?::time)
                  ", [
                      $currentTime->format('H:i:s'),
                      $currentTime->format('H:i:s')
                  ]);
              });
        });
    }

    private function mapDayToShort($englishDay)
    {
        return match ($englishDay) {
            'Mon' => 'Mo',
            'Tue' => 'Tu',
            'Wed' => 'We',
            'Thu' => 'Th',
            'Fri' => 'Fr',
            'Sat' => 'Sa',
            'Sun' => 'Su',
            default => 'Mo'
        };
    }

    private function getPriceBounds()
    {
        return Establishment::query()
            ->selectRaw("
                COALESCE(MAX(
                    (regexp_match(split_part(average_bill, '–', 2), '\d+'))[1]::integer
                ), 100000) as max_price,
                COALESCE(MIN(
                    (regexp_match(split_part(average_bill, '–', 1), '\d+'))[1]::integer
                ), 0) as min_price
            ")
            ->whereNotNull('average_bill') // Исключаем null для расчета границ
            ->first();
    }
    
    private function validateRatingInputs()
    {
        $this->min_rating = is_numeric($this->min_rating) 
            ? (float)$this->min_rating 
            : 0;

        $this->max_rating = is_numeric($this->max_rating)
            ? (float)$this->max_rating
            : 5;

        // Гарантируем, что min <= max
        if ($this->min_rating > $this->max_rating) {
            [$this->min_rating, $this->max_rating] = [$this->max_rating, $this->min_rating];
        }
    }
}
