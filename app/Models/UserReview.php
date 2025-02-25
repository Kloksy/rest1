<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    public $table = 'user_reviews';

    public $fillable = [
        'user_id',
        'establishment_id',
        'content',
        'rating'
    ];

    protected $casts = [
        'content' => 'string',
        'rating' => 'float'
    ];

    public static array $rules = [
        'user_id' => 'required',
        'establishment_id' => 'required',
        'content' => 'required|string',
        'rating' => 'nullable|numeric',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function establishment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Establishment::class, 'establishment_id');
    }
}
