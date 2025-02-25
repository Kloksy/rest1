<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class YandexReview extends Model
{
    public $table = 'yandex_reviews';

    public $fillable = [
        'user_name',
        'establishment_id',
        'content',
        'rating'
    ];

    protected $casts = [
        'user_name' => 'string',
        'content' => 'string',
        'rating' => 'float'
    ];

    public static array $rules = [
        'user_name' => 'required|string|max:255',
        'establishment_id' => 'required',
        'content' => 'required|string',
        'rating' => 'nullable|numeric',
        'created_at' => 'nullable'
    ];

    public function establishment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Establishment::class, 'establishment_id');
    }
}
