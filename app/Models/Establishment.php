<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Establishment extends Model
{
    public $table = 'establishments';

    public $fillable = [
        'name',
        'type_id',
        'average_bill',
        'price_category',
        'latitude',
        'longitude',
        'address',
        'rating',
        'reviews_count',
        'logo_url'
    ];

    protected $casts = [
        'name' => 'string',
        'average_bill' => 'string',
        'price_category' => 'string',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'address' => 'string',
        'rating' => 'float',
        'logo_url' => 'string'
    ];

    public static array $rules = [
        'name' => 'required|string|max:255',
        'type_id' => 'nullable',
        'average_bill' => 'nullable|string|max:255',
        'price_category' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'address' => 'nullable|string|max:255',
        'rating' => 'nullable|numeric',
        'reviews_count' => 'nullable',
        'logo_url' => 'nullable|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    // В модели Establishment
    public function getMinPriceAttribute()
    {
        preg_match('/\d+/', explode('–', $this->average_bill)[0], $matches);
        return (int)($matches[0] ?? 0);
    }

    public function getMaxPriceAttribute()
    {
        $parts = explode('–', $this->average_bill);
        if (count($parts) < 2) return 0;
        preg_match('/\d+/', $parts[1], $matches);
        return (int)($matches[0] ?? 0);
    }

    public function getPriceRangeAttribute()
    {
        if (!$this->average_bill) return [null, null];
        
        $parts = explode('–', $this->average_bill);
        $min = (int)preg_replace('/\D/', '', $parts[0]);
        $max = isset($parts[1]) ? (int)preg_replace('/\D/', '', $parts[1]) : $min;
        
        return [$min, $max];
    }

    public function scopeSearchByName($query, $name)
    {
        return $query->when($name, fn($q) => $q->where('name', 'like', "%{$name}%"));
    }

    public function scopeFilterByType($query, $typeId)
    {
        return $query->when($typeId, fn($q) => $q->where('type_id', $typeId));
    }

    public function scopeFilterByCuisines($query, array $cuisineIds)
    {
        return $query->when($cuisineIds, fn($q) => $q->whereHas('cuisines', 
            fn($q) => $q->whereIn('id', $cuisineIds)));
    }

    public function scopeFilterByServices($query, array $generalInfoIds)
    {
        return $query->when($generalInfoIds, fn($q) => $q->whereHas('generalInfos', 
            fn($q) => $q->whereIn('id', $generalInfoIds)));
    }

    public function scopeFilterByPriceCategory($query, $priceCategory)
    {
        return $query->when($priceCategory, fn($q) => $q->where('price_category', $priceCategory));
    }

    public function scopeFilterByRatingRange($query, $minRating, $maxRating)
    {
        return $query->whereBetween('rating', [$minRating, $maxRating]); 
    }

    public function scopeFilterByPriceRange($query, $minPrice, $maxPrice, $includeNoPrice)
    {
        return $query->when($minPrice || $maxPrice, function($query, $minPrice, $maxPrice, $includeNoPrice) {
            $query->where(function($query, $minPrice, $maxPrice, $includeNoPrice) {
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
                    )".($includeNoPrice ? " OR average_bill IS NULL" : "")."
                ", [$minPrice, $maxPrice]);
            });
        }); 
    }

    public function scopeFilterOpenNow($query, Carbon $time, $openNow)
    {
        if($openNow)
        {
            $shortDay = self::mapDayToShort($time->format('D'));
            
            return $query->whereHas('workingHours', function($q) use ($shortDay, $time) {
                $q->where('day', $shortDay)
                ->whereRaw("(hours ~ '^\d{2}:\d{2}-\d{2}:\d{2}$'
                    AND split_part(hours, '-', 1)::time <= ?::time
                    AND split_part(hours, '-', 2)::time >= ?::time)",
                    [$time->format('H:i:s'), $time->format('H:i:s')]
                );
            });
        }
    }

    public static function getPriceBounds()
    {
        return self::query()
            ->selectRaw("
                COALESCE(MAX((regexp_match(split_part(average_bill, '–', 2), '\d+'))[1]::integer), 100000) as max_price,
                COALESCE(MIN((regexp_match(split_part(average_bill, '–', 1), '\d+'))[1]::integer), 0) as min_price
            ")
            ->whereNotNull('average_bill')
            ->first();
    }

    public static function mapDayToShort($englishDay)
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

    public function calculateUserRating()
    {
        // Вычисляем средний рейтинг из всех пользовательских отзывов
        $averageRating = $this->userReviews()->avg('rating');

        // Если нет отзывов, возвращаем null или 0
        if (is_null($averageRating)) {
            return 0; // Можно вернуть null, если хотите отображать "Нет данных"
        }

        // Округляем рейтинг до одного знака после запятой
        return round($averageRating, 1);
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\EstablishmentType::class, 'type_id');
    }

    public function cuisines(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\Cuisine::class, 'establishment_cuisine');
    }

    public function workingHours(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\WorkingHour::class, 'establishment_id');
    }

    public function contacts(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Contact::class, 'establishment_id');
    }

    public function userInteractions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\UserInteraction::class, 'establishment_id');
    }

    public function userReviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\UserReview::class, 'establishment_id');
    }

    public function yandexReviews(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\YandexReview::class, 'establishment_id');
    }

    public function photos(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(\App\Models\Photo::class, 'establishment_id');
    }

    public function generalInfos(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(\App\Models\GeneralInfo::class, 'establishment_general_info');
    }
}
