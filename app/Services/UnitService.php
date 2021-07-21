<?php

namespace App\Services;

use App\Repositories\UnitRepository;

class UnitService
{
    public function __construct(UnitRepository $unitRepo)
    {
        $this->unitRepo = $unitRepo;
    }

    public function getAll()
    {
        return $this->unitRepo->getAll();
    }

}
