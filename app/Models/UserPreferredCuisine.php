<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreferredCuisine extends Model
{
    public $table = 'user_preferred_cuisines';

    public $fillable = [
        'cuisine_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'cuisine_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function cuisine(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Cuisine::class, 'cuisine_id');
    }
}
