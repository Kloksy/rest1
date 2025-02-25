<?php

namespace App\Repositories;

use App\Models\UserPreference;
use App\Repositories\BaseRepository;

class UserPreferenceRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'price_category',
        'latitude',
        'longitude',
        'preferred_time_from',
        'preferred_time_to'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserPreference::class;
    }
}
