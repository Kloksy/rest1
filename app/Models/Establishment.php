<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
