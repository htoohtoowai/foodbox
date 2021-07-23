<?php

namespace App\Repositories;

use App\Models\Donor;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Donee;
use App\Models\Donation;

class DonorRepository extends BaseRepository
{
    public function __construct(Donor $model,Donee $doneeModel,Donation $donationModel)
    {
        $this->model = $model;
        $this->perPage = config('enum.perPage');
        $this->donationModel =  $donationModel;
        $this->doneeModel = $doneeModel;

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
            $data = $this->doneeModel->find($id);
            $donor = $this->model->create(
                [
                'category_items_id'=>  $data['category_items_id'],
                'member_id'=>$request->user()->id,
                'qty'=> $data['qty'],
                'unit_id' =>  $data['unit_id'],
                'status' =>  config('enum.status.inprogress'),
                'notes' =>   $data['note']
                ]);

                return $this->donationModel->create(
                    [
                    'category_items_id'=>  $data['category_items_id'],
                    'donee_id'=> $id,
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
               return  $this->donationModel->create(
                    [
                    'category_items_id'=>  $request['categoryItemsId'],
                    'donee_id'=> $id,
                    'donor_id'=> $donor->id,
                    'qty'=> $request['qty'],
                    'unit_id' =>  $request['unitId'],
                    'notes' =>   $request['note']
                    ]);
        }

    }

    public function changeDoneStaus($id)
    {
        return $this->model->where('id',$id)->update(['status' => config('enum.status.done')]);
    }

}
