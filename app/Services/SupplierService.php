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

}
