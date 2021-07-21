<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\BaseResourceCollection;

class DoneeResourceCollection extends ResourceCollection
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
