<?php

namespace App\Repositories;

use App\Models\UserPreferredCuisine;
use App\Repositories\BaseRepository;

class UserPreferredCuisineRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'cuisine_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserPreferredCuisine::class;
    }
}
