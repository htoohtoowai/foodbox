<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Members\Member;

class Donee extends Model
{
    use HasFactory;
    protected $table ="donees";
    protected $guarded = [];

    public function scopeFilter($query, $filters)
    {
        $filters->apply($query);
    }
    public function categoryItem()
    {
        return $this->belongsTo(CategoryItem::class, 'category_items_id', 'id');
    }
    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id', 'id');
    }
}
