<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    public $table = 'user_preferences';

    public $fillable = [
        'user_id',
        'price_category',
        'latitude',
        'longitude',
        'preferred_time_from',
        'preferred_time_to'
    ];

    protected $casts = [
        'price_category' => 'string',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'price_category' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
        'preferred_time_from' => 'nullable',
        'preferred_time_to' => 'nullable',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }
}
