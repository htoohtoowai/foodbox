<?php

namespace App\Repositories;

use App\Models\Suppliers\Supplier;
use App\Models\Suppliers\SupplierAddress;

class SupplierRepository extends BaseRepository
{
    public function __construct(Supplier $model,SupplierAddress $supplierModel,TwonRepository $townRepo)
    {
        $this->model = $model;
        $this->supplierModel = $supplierModel;
        $this->townRepo = $townRepo;
        $this->perPage = config('enum.perPage');
    }
    public function store($request)
    {
        $supplier = $this->model->create([
            'supplier_category'=> $request['supplierCategory'],
            'name_en' => $request['nameEN'],
            'name_mm' =>$request['nameMM']
        ]);

        foreach ($request['addressInfo'] as $address) {
            if($this->townRepo->isExitTownByTownPcode($address['townPcode'])){
                $this->supplierModel->create([
                    'supplier_id'=> $supplier->id,
                    'town_pcode'=> $address['townPcode'],
                    'phone'=> $address['phone'],
                    'address_en' =>  $address['addressEN'],
                    'address_mm' =>   $address['addressMM']
                ]);
            }
        }
        return true;
    }
}
