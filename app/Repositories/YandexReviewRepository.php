<?php

namespace App\Repositories;

use App\Models\YandexReview;
use App\Repositories\BaseRepository;

class YandexReviewRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'user_name',
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
        return YandexReview::class;
    }
}
