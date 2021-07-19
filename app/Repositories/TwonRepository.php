<?php

namespace App\Repositories;

use App\Models\Town;

class TwonRepository extends BaseRepository
{
    public function __construct(Town $model)
    {
        $this->model = $model;
    }
    public function getBySrPcode($pcode)
    {
        return $this->model->where('sr_pcode', "$pcode")->get();
    }
}
