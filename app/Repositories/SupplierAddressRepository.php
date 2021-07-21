<?php

namespace App\Repositories;

use App\Models\Suppliers\SupplierAddress;

class SupplierAddressRepository extends BaseRepository
{
    public function __construct(SupplierAddress $model)
    {
        $this->model = $model;
    }
    public function update($request,$id)
    {
        return   $this->model->where('id',$id)->update([
            'supplier_id'=> $request['supplierId'],
            'town_pcode'=> $request['townPcode'],
            'phone'=> $request['phone'],
            'address_en' =>  $request['addressEN'],
            'address_mm' =>   $request['addressMM']
        ]);
    }
    public function isExistAddressWithSupplier($request,$id)
    {
        return $this->model->where('id',$id)->where('supplier_id', $request['supplierId'])->first();
    }
}
