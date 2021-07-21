<?php

namespace App\Models\Suppliers;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use  App\Models\Town;
class SupplierAddress extends Model
{
    use HasFactory;
    protected $table ="supplier_addresses";
    protected $guarded = [];
    public $timestamps = false;

    public function town()
    {
        return $this->hasOne(Town::class, 'town_pcode', 'town_pcode');
    }
}
