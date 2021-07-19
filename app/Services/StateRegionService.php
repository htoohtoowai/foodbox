<?php

namespace App\Services;

use App\Repositories\StateRegionRepository;

class StateRegionService
{
    public function __construct(StateRegionRepository $stateRegionRepo)
    {
        $this->stateRegionRepo = $stateRegionRepo;
    }

    public function getAll()
    {
        return $this->stateRegionRepo->getAll();
    }

}
