<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table ="categories";
    protected $guarded = [];
    public $timestamps = false;

 /**
 * Get all of the comments for the Category
 *
 * @return \Illuminate\Database\Eloquent\Relations\HasMany
 */
public function categoryItem()
{
    return $this->hasMany(categoryItem::class, 'category_id', 'id');
}
}
