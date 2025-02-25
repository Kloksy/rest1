<?php

namespace App\Repositories;

use App\Models\GeneralInfo;
use App\Repositories\BaseRepository;

class GeneralInfoRepository extends BaseRepository
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
        return GeneralInfo::class;
    }
}
