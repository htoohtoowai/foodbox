<?php

namespace App\Http\Filters;

use Illuminate\Support\Facades\DB;
use App\Http\Filters\Filters;

class SupplierFliter extends Filters
{
    protected $filters = [
        'keyword',
    ];

    public function keyword($value)
    {
        return $this->builder
            ->where(function ($query) use ($value) {
                $query->where('name_en', 'LIKE', "%{$value}%")
                    ->orWhere('name_mm', 'LIKE', "%{$value}%");
            });
    }
}
