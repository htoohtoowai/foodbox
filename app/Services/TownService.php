<?php

namespace App\Services;

use App\Exceptions\NotFoundException;
use App\Repositories\StateRegionRepository;
use App\Repositories\TwonRepository;
class TownService
{
    public function __construct(TwonRepository $townRepo,StateRegionRepository $stateRegionRepo)
    {
        $this->townRepo = $townRepo;
        $this->stateRegionRepo = $stateRegionRepo;
    }

    public function getByStateRegionPcode($pcode)
    {
        if(!$this->stateRegionRepo->getBySrPcode($pcode)){
            throw new NotFoundException(trans('message.notFound'));
        }
        return $this->townRepo->getBySrPcode($pcode);
    }

}
