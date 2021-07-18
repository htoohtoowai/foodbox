<?php

namespace App\Models\Suppliers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierAddress extends Model
{
    use HasFactory;
    protected $table ="supplier_addresses";
    protected $guarded = [];
    public $timestamps = false;
}
