<?php

namespace App\Services;

use App\Repositories\DonorRepository;
use App\Repositories\CategoryItemRepository;
use App\Repositories\UnitRepository;
use App\Exceptions\NotFoundException;
use Laravel\Sanctum\HasApiTokens;
use App\Repositories\DoneeRepository;
use App\Repositories\DonationRepository;

class DonorService
{
    public function __construct(DonorRepository $donorRepo,CategoryItemRepository $categoryItemRepo,UnitRepository $unitRepo,DoneeRepository $doneeRepo,DonationRepository $donationRepo)
    {
        $this->donorRepo = $donorRepo;
        $this->categoryItemRepo = $categoryItemRepo;
        $this->unitRepo = $unitRepo;
        $this->doneeRepo = $doneeRepo;
        $this->donationRepo = $donationRepo;


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
    public function takeDonation($request,$id)
    {

        if(!$this->donorRepo->getById($id)){
            throw new NotFoundException(trans('message.notFound'));
        }
        /*** Clone Donee Information and Store Donation History***/
        $this->doneeRepo->cloneDoneeFromDonor($request,$id);
        /***Push notification to related donee***/
        return $this->donorRepo->update(['status' => config('enum.status.inprogress')],$id);
    }

    public function done($request,$id)
    {
        if(!$this->donorRepo->getById($id) || !$this->donorRepo->isExistDonorByAuthMember($request,$id)){
            throw new NotFoundException(trans('message.notFound'));
        }
        $donation = $this->donationRepo->getDonationByDonorID($id);
        $this->doneeRepo->changeDoneStaus($donation->donee_id);
        /***Push notification to related donee***/
        return $this->donorRepo->update(['status' => config('enum.status.done')],$id);
    }

}
