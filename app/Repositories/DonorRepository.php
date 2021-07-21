<?php

namespace App\Repositories;

use App\Models\Donor;
use Laravel\Sanctum\HasApiTokens;

class DonorRepository extends BaseRepository
{
    public function __construct(Donor $model)
    {
        $this->model = $model;
        $this->perPage = config('enum.perPage');

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
}
