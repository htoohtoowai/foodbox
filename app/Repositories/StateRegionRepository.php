<?php

namespace App\Repositories;

use App\Models\StateRegion;

class StateRegionRepository extends BaseRepository
{
    public function __construct(StateRegion $model)
    {
        $this->model = $model;
    }
    public function getAll()
    {
        return $this->model->orderBy('sr_pcode', 'DESC')->get();
    }
    public function getBySrPcode($pcode)
    {
        return $this->model->where('sr_pcode', $pcode)->first();
    }
}
