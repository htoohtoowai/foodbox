<?php

namespace App\Http\Filters;

use Illuminate\Support\Facades\DB;
use App\Http\Filters\Filters;

class DoneeFliter extends Filters
{
    protected $filters = [
        'keyword',
    ];

    public function keyword($value)
    {
        return $this->builder
            ->where(function ($query) use ($value) {
                $query->where('category_items_id', 'LIKE', "%{$value}%")
                    ->orWhere('member_id', 'LIKE', "%{$value}%");
            });
    }
}
