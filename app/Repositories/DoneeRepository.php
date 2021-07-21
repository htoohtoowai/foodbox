<?php

namespace App\Repositories;

use App\Models\Donee;
use Laravel\Sanctum\HasApiTokens;

class DoneeRepository extends BaseRepository
{
    public function __construct(Donee $model)
    {
        $this->model = $model;
        $this->perPage = config('enum.perPage');

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
}
