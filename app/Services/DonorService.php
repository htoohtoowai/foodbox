<?php

namespace App\Services;

use App\Repositories\DonorRepository;
use App\Repositories\CategoryItemRepository;
use App\Repositories\UnitRepository;
use App\Exceptions\NotFoundException;
use Laravel\Sanctum\HasApiTokens;

class DonorService
{
    public function __construct(DonorRepository $donorRepo,CategoryItemRepository $categoryItemRepo,UnitRepository $unitRepo)
    {
        $this->donorRepo = $donorRepo;
        $this->categoryItemRepo = $categoryItemRepo;
        $this->unitRepo = $unitRepo;

    }

    public function getAllByNextId($filter, $nextId)
    {
        return $this->donorRepo->getPaginatedByFilterAndNextId($filter, $nextId);
    }
    public function detail($id)
    {
        $donor = $this->donorRepo->getById($id);
        if(!$donor){
            throw new NotFoundException(trans('message.notFound'));
        }
        return $donor;
    }

    public function store($request)
    {
        foreach ($request->donors as $donor) {
            if(!$this->categoryItemRepo->getById($donor['categoryItemsId'])||!$this->unitRepo->getById($donor['unitId'])){
                throw new NotFoundException(trans('message.notFound'));
            }
        }
        return $this->donorRepo->store($request);
    }
    public function update($request,$id)
    {
        if(!$this->donorRepo->getById($id) || !$this->donorRepo->isExistDonorByAuthMember($request,$id)){
            throw new NotFoundException(trans('message.notFound'));
        }
       return $this->donorRepo->update(
                                    [
                                    'category_items_id'=>  $request['categoryItemsId'],
                                    'member_id'=>$request->user()->id,
                                    'qty'=> $request['qty'],
                                    'unit_id' =>  $request['unitId'],
                                    'status' =>  config('enum.status.require'),
                                    'notes' =>   $request['note']
                                    ],$id);
    }

    public function delete($request,$id)
    {
        if(!$this->donorRepo->getById($id) || !$this->donorRepo->isExistDonorByAuthMember($request,$id)){
            throw new NotFoundException(trans('message.notFound'));
        }
        return $this->donorRepo->delete($id);
    }

    public function changeStatus($request,$id,$status)
    {
        if(!$this->donorRepo->getById($id) || !$this->donorRepo->isExistDonorByAuthMember($request,$id)||$status<config('enum.status.require')||$status>config('enum.status.done')){
            throw new NotFoundException(trans('message.notFound'));
        }
        return $this->donorRepo->update(['status' => $status],$id);
    }

}
