<?php

namespace App\Repositories;

use App\Models\Cuisine;
use App\Repositories\BaseRepository;

class CuisineRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Cuisine::class;
    }
}
