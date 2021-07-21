<?php

namespace App\Repositories;

use App\Models\Unit;

class UnitRepository extends BaseRepository
{
    public function __construct(Unit $model)
    {
        $this->model = $model;
    }
}
