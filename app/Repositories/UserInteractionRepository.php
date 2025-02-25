<?php

namespace App\Repositories;

use App\Models\UserInteraction;
use App\Repositories\BaseRepository;

class UserInteractionRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'establishment_id',
        'review_id',
        'viewed_at'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserInteraction::class;
    }
}
