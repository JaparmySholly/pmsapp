<?php

namespace App\Repositories\Eloquent\Repository;
use App\Models\Industry;
class IndustryRepository extends BaseRepository
{
    public function __construct(Industry $model)
    {
        parent::__construct($model);
    }
}

