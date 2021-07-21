<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\BaseResourceCollection;

class DonorResourceCollection extends ResourceCollection
{
    use BaseResourceCollection;

    public function toArray($request)
    {
        return [
            'result' => $this->collection,
            'pagination' => $this->pagination
        ];
    }
}
