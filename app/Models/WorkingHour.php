<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

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

    // public function getOpenTimeAttribute()
    // {
    //     return $this->parseTime(split_part($this->hours, '-', 1));
    // }

    // public function getCloseTimeAttribute()
    // {
    //     return $this->parseTime(split_part($this->hours, '-', 2));
    // }

    private function parseTime($timeStr)
    {
        try {
            return Carbon::createFromFormat('H:i', trim($timeStr));
        } catch (\Exception $e) {
            return null;
        }
    }

    public function establishment(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Establishment::class, 'establishment_id');
    }
}
