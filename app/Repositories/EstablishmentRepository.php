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

    public function getFilteredEstablishments(array $filters)
    {
        return Establishment::query()
            ->searchByName($filters['name'])
            ->filterByType($filters['type_id'])
            ->filterByCuisines($filters['cuisine_ids'])
            ->filterByPriceCategory($filters['price_category'])
            ->filterByServices($filters['general_info_ids'])
            ->filterOpenNow($filters['current_time'], $filters['open_now'])
            ->filterByRatingRange($filters['min_rating'], $filters['max_rating'])
            ->filterByPriceRange($filters['min_price'], $filters['max_price'], $filters['include_no_price'])
            ->orderBy($filters['sort_type'], $filters['sort_direction'])
            ->with(['cuisines', 'generalInfos', 'workingHours'])
            ->paginate(9);
    }
}
