<?php

namespace App\Models\Suppliers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $table ="suppliers";
    protected $guarded = [];
    public $timestamps = false;

    public function scopeFilter($query, $filters)
    {
        $filters->apply($query);
    }

    public function supplierAddress()
    {
        return $this->hasMany(SupplierAddress::class, 'supplier_id', 'id');
    }
}
