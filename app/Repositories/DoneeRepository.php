<?php

namespace App\Repositories;

use App\Models\Donee;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Donation;
use App\Models\Donor;

class DoneeRepository extends BaseRepository
{
    public function __construct(Donee $model,Donor $donorModel,Donation $donationModel)
    {
        $this->model = $model;
        $this->perPage = config('enum.perPage');
        $this->donationModel =  $donationModel;
        $this->donorModel = $donorModel;

    }

    public function store($request)
    {
        foreach ($request->donees as $donee) {
            $this->model->create(
                [
                'category_items_id'=>  $donee['categoryItemsId'],
                'member_id'=>$request->user()->id,
                'qty'=> $donee['qty'],
                'unit_id' =>  $donee['unitId'],
                'status' =>  config('enum.status.require'),
                'notes' =>   $donee['note']
                ]);
            }
        return true;
    }

    public function isExistDoneeByAuthMember($request,$id)
    {
        return $this->model->where('id', $id)->where('member_id', $request->user()->id)->first();
    }
    public function cloneDoneeFromDonor($request,$id)
    {
        if($request['takeStatus']==config('enum.takeStatus.all')){
            $data =$this->donorModel->find($id);
            $donee = $this->model->create(
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
                    'donor_id'=> $id,
                    'donee_id'=> $donee->id,
                    'qty'=> $data['qty'],
                    'unit_id' =>  $data['unit_id'],
                    'notes' =>   $data['note']
                    ]);
        }else{
            $donee =  $this->model->create(
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
                    'donor_id'=> $id,
                    'donee_id'=> $donee->id,
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
