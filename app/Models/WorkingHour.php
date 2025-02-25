<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkingHour extends Model
{
    public $table = 'working_hours';

    public $fillable = [
        'establishment_id',
        'day',
        'hours'
    ];

    protected $casts = [
        'day' => 'string',
        'hours' => 'string'
    ];

    public static array $rules = [
        'establishment_id' => 'required',
        'day' => 'required|string|max:255',
        'hours' => 'required|string|max:255',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function establishment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Establishment::class, 'establishment_id');
    }
}
