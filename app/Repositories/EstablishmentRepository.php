<?php

namespace App\Repositories;

use App\Models\Establishment;
use App\Repositories\BaseRepository;

class EstablishmentRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'name',
        'type_id',
        'average_bill',
        'price_category',
        'latitude',
        'longitude',
        'address',
        'rating',
        'reviews_count',
        'logo_url'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Establishment::class;
    }

    public function findWithRelations($id, array $relations = [])
    {
        // Список стандартных связей
        $defaultRelations = [
            'cuisines',
            'generalInfos',
            'type',
            'yandexReviews' => function ($query) {
                $query->orderByDesc('created_at');
            },
            'userReviews' => function ($query) {
                $query->orderByDesc('created_at');
            },
        ];

        // Если переданы дополнительные связи, объединяем их со стандартными
        $relations = array_merge($defaultRelations, $relations);

        return Establishment::with($relations)->find($id);
    }
}
