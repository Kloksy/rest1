<?php

namespace App\Repositories;

use App\Models\UserPreferredType;
use App\Repositories\BaseRepository;

class UserPreferredTypeRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'type_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserPreferredType::class;
    }
}
