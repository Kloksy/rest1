<?php

namespace App\Repositories;

use App\Models\Photo;
use App\Repositories\BaseRepository;

class PhotoRepository extends BaseRepository
{
    protected $fieldSearchable = [
        'establishment_id',
        'url'
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return Photo::class;
    }
}
