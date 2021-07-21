<?php

namespace App\Services;

use App\Repositories\SupplierRepository;
use App\Exceptions\NotFoundException;

class SupplierService
{

    public function __construct(SupplierRepository $supplierRepo)
    {
        $this->supplierRepo = $supplierRepo;
    }
    public function getAllByNextId($filter, $nextId)
    {
        return $this->supplierRepo->getPaginatedByFilterAndNextId($filter, $nextId);
    }

    public function store($request)
    {
        return $this->supplierRepo->store($request);
    }

    public function update($request,$id)
    {
        if(!$this->supplierRepo->getById($id)){
            throw new NotFoundException(trans('message.notFound'));
        }
       return $this->supplierRepo->update(
                                    ['supplier_category'=>$request['supplierCategory'],
                                    'name_en'=>$request['nameEN'],
                                    'name_mm'=>$request['nameMM'],
                                    ],$id);
    }
    public function detail($id)
    {
        $supplier = $this->supplierRepo->getById($id);
        if(!$supplier){
            throw new NotFoundException(trans('message.notFound'));
        }
        return $supplier;
    }

}
