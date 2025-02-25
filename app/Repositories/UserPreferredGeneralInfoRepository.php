<?php

namespace App\Repositories;

use App\Models\UserPreferredGeneralInfo;
use App\Repositories\BaseRepository;

class UserPreferredGeneralInfoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'general_info_id'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return UserPreferredGeneralInfo::class;
    }
}
