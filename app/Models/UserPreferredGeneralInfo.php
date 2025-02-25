<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreferredGeneralInfo extends Model
{
    public $table = 'user_preferred_general_info';

    public $fillable = [
        'general_info_id'
    ];

    protected $casts = [
        
    ];

    public static array $rules = [
        'general_info_id' => 'required',
        'created_at' => 'nullable',
        'updated_at' => 'nullable'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function generalInfo(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\GeneralInfo::class, 'general_info_id');
    }
}
