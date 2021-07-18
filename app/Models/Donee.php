<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donee extends Model
{
    use HasFactory;
    protected $table ="donees";
    protected $guarded = [];
}
