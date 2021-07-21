<?php

namespace App\Services;

use App\Repositories\SupplierAddressRepository;
use App\Repositories\SupplierRepository;
use App\Repositories\TwonRepository;
use App\Exceptions\NotFoundException;

class SupplierAddressService
{

    public function __construct(SupplierAddressRepository $supplierAddressRepo,SupplierRepository $supplierRepo,TwonRepository $townRepo)
    {
        $this->supplierAddressRepo = $supplierAddressRepo;
        $this->supplierRepo = $supplierRepo;
        $this->townRepo = $townRepo;
    }


    public function update($request,$id)
    {
        if(!$this->supplierAddressRepo->getById($id) || !$this->supplierRepo->getById($request['supplierId'])||!$this->supplierAddressRepo->isExistAddressWithSupplier($request,$id)||!$this->townRepo->isExitTownByTownPcode($request['townPcode'])){
            throw new NotFoundException(trans('message.notFound'));
        }
       return $this->supplierAddressRepo->update($request,$id);
    }

}
