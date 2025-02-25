<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreferredType extends Model
{
    public $table = 'user_preferred_types';

    public $fillable = [
        'type_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'type_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function type(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\EstablishmentType::class, 'type_id');
    }
}
