<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    public $table = 'contacts';

    public $fillable = [
        'establishment_id',
        'type',
        'value'
    ];

    protected $casts = [
        'type' => 'string',
        'value' => 'string'
    ];

    public static array $rules = [
        'establishment_id' => 'required',
        'type' => 'required|string|max:255',
        'value' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function establishment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Establishment::class, 'establishment_id');
    }
}
