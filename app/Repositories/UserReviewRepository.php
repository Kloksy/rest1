<?php

namespace App\Repositories;

use App\Models\UserReview;
use App\Repositories\BaseRepository;

class UserReviewRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_id',
        'establishment_id',
        'content',
        'rating'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserReview::class;
    }
}
