<?php

namespace App\Repositories;

use App\Models\Donor;
use Laravel\Sanctum\HasApiTokens;
use App\Repositories\DoneeRepository;

class DonorRepository extends BaseRepository
{
    public function __construct(Donor $model,DoneeRepository $doneeRepo,Donation $donationModel)
    {
        $this->model = $model;
        $this->perPage = config('enum.perPage');
        $this->donationModel =  $donationModel;
        $this->doneeRepo = $doneeRepo;

    }

    public function store($request)
    {
        foreach ($request->donors as $donor) {
            $this->model->create(
                [
                'category_items_id'=>  $donor['categoryItemsId'],
                'member_id'=>$request->user()->id,
                'qty'=> $donor['qty'],
                'unit_id' =>  $donor['unitId'],
                'status' =>  config('enum.status.require'),
                'notes' =>   $donor['note']
                ]);
            }
        return true;
    }

    public function isExistDonorByAuthMember($request,$id)
    {
        return $this->model->where('id', $id)->where('member_id', $request->user()->id)->first();
    }

    public function cloneDonorFromDonee($request,$id)
    {
        if($request['donateStatus']==config('enum.donateStatus.all')){
            $data = $this->doneeRepo->getById($id);
            $donor = $this->model->create(
                [
                'category_items_id'=>  $data['category_items_id'],
                'member_id'=>$request->user()->id,
                'qty'=> $data['qty'],
                'unit_id' =>  $data['unit_id'],
                'status' =>  config('enum.status.inprogress'),
                'notes' =>   $data['note']
                ]);

                return $this->donationRepo->create(
                    [
                    'category_items_id'=>  $data['category_items_id'],
                    'donor_id'=> $id,
                    'donor_id'=> $donor->id,
                    'qty'=> $data['qty'],
                    'unit_id' =>  $data['unit_id'],
                    'notes' =>   $data['note']
                    ]);
        }else{
            $donor =  $this->model->create(
                [
                'category_items_id'=>  $request['categoryItemsId'],
                'member_id'=>$request->user()->id,
                'qty'=> $request['qty'],
                'unit_id' =>  $request['unitId'],
                'status' =>  config('enum.status.inprogress'),
                'notes' =>   $request['note']
                ]);
               return  $this->donationRepo->create(
                    [
                    'category_items_id'=>  $request['categoryItemsId'],
                    'donor_id'=> $id,
                    'donor_id'=> $donor->id,
                    'qty'=> $request['qty'],
                    'unit_id' =>  $request['unitId'],
                    'notes' =>   $request['note']
                    ]);
        }

    }

    public function changeDoneStaus($id)
    {
        return $this->model->update(['status' => config('enum.status.done')],$id);
    }

}
