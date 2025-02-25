<?php

namespace App\Repositories;

use App\Models\WorkingHour;
use App\Repositories\BaseRepository;

class WorkingHourRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'establishment_id',
        'day',
        'hours'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return WorkingHour::class;
    }
}
