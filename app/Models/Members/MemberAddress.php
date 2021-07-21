<?php

namespace App\Models\Members;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberAddress extends Model
{
    use HasFactory;
    protected $table ="members_addresses";
    protected $guarded = [];
    public $timestamps = false;
}
