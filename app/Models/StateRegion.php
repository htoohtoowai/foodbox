<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StateRegion extends Model
{
    use HasFactory;
    protected $table ="state_regions";
    protected $primaryKey = 'sr_pcode';
    protected $keyType = 'string';
    public $incrementing = false;
    protected $guarded = [];
}
