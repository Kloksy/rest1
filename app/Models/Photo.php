<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public $table = 'photos';

    public $fillable = [
        'establishment_id',
        'url'
    ];

    protected $casts = [
        'url' => 'string'
    ];

    public static array $rules = [
        'establishment_id' => 'required',
        'url' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function establishment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Establishment::class, 'establishment_id');
    }
}
