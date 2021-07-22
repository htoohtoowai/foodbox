<?php

namespace App\Services;

use App\Repositories\DoneeRepository;
use App\Repositories\CategoryItemRepository;
use App\Repositories\UnitRepository;
use App\Exceptions\NotFoundException;
use Laravel\Sanctum\HasApiTokens;
use App\Repositories\DonorRepository;
use App\Repositories\DonationRepository;

class DoneeService
{
    public function __construct(DoneeRepository $doneeRepo,CategoryItemRepository $categoryItemRepo,UnitRepository $unitRepo,DonorRepository $donorRepo,DonationRepository $donationRepo)
    {
        $this->doneeRepo = $doneeRepo;
        $this->categoryItemRepo = $categoryItemRepo;
        $this->unitRepo = $unitRepo;
        $this->donorRepo = $donorRepo;
        $this->donationRepo = $donationRepo;

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

    public function donate($request,$id)
    {
        if(!$this->doneeRepo->getById($id)){
            throw new NotFoundException(trans('message.notFound'));
        }
        /*** Clone Donee Information and Store Donation History***/
        $this->donorRepo->cloneDonorFromDonee($request,$id,$status);
        /***Push notification to related donee***/
        return $this->doneeRepo->update(['status' => config('enum.status.inprogress')],$id);
    }
    public function done($request,$id)
    {
        if(!$this->doneeRepo->getById($id) || !$this->doneeRepo->isExistDonorByAuthMember($request,$id)){
            throw new NotFoundException(trans('message.notFound'));
        }
        /***Push notification to related donee***/
        $donation = $this->donationRepo->getDonationByDoneeID($id);
        $this->donorRepo->changeDoneStaus($donation->donor_id);

        return $this->doneeRepo->update(['status' => config('enum.status.done')],$id);
    }

}
