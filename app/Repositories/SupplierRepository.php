<?php

namespace App\Repositories;

use App\Models\Suppliers\Supplier;

class SupplierRepository extends BaseRepository
{
    public function __construct(Supplier $model)
    {
        $this->model = $model;
        $this->perPage = config('enum.perPage');
    }
}
