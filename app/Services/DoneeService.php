<?php

namespace App\Services;

use App\Repositories\DoneeRepository;
use App\Repositories\CategoryItemRepository;
use App\Repositories\UnitRepository;
use App\Exceptions\NotFoundException;
use Laravel\Sanctum\HasApiTokens;

class DoneeService
{
    public function __construct(DoneeRepository $doneeRepo,CategoryItemRepository $categoryItemRepo,UnitRepository $unitRepo)
    {
        $this->doneeRepo = $doneeRepo;
        $this->categoryItemRepo = $categoryItemRepo;
        $this->unitRepo = $unitRepo;

    }

    public function getAllByNextId($filter, $nextId)
    {
        return $this->doneeRepo->getPaginatedByFilterAndNextId($filter, $nextId);
    }
    public function detail($id)
    {
        $donee = $this->doneeRepo->getById($id);
        if(!$donee){
            throw new NotFoundException(trans('message.notFound'));
        }
        return $donee;
    }

    public function store($request)
    {
        foreach ($request->donees as $donee) {
            if(!$this->categoryItemRepo->getById($donee['categoryItemsId'])||!$this->unitRepo->getById($donee['unitId'])){
                throw new NotFoundException(trans('message.notFound'));
            }
        }
        return $this->doneeRepo->store($request);
    }
    public function update($request,$id)
    {
        if(!$this->doneeRepo->getById($id) || !$this->doneeRepo->isExistDoneeByAuthMember($request,$id)){
            throw new NotFoundException(trans('message.notFound'));
        }
       return $this->doneeRepo->update(
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
        if(!$this->doneeRepo->getById($id) || !$this->doneeRepo->isExistDoneeByAuthMember($request,$id)){
            throw new NotFoundException(trans('message.notFound'));
        }
        return $this->doneeRepo->delete($id);
    }

    public function changeStatus($request,$id,$status)
    {
        if(!$this->doneeRepo->getById($id) || !$this->doneeRepo->isExistDoneeByAuthMember($request,$id)||$status<config('enum.status.require')||$status>config('enum.status.done')){
            throw new NotFoundException(trans('message.notFound'));
        }
        return $this->doneeRepo->update(['status' => $status],$id);
    }

}
