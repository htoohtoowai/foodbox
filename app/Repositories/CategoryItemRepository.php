<?php

namespace App\Repositories;

use App\Models\CategoryItem;

class CategoryItemRepository extends BaseRepository
{
    public function __construct(CategoryItem $model)
    {
        $this->model = $model;
    }
}
