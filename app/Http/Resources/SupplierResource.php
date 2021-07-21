<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'name' => changeLanguage($request, $this->name_en, $this->name_mm),
            'addressInfo'=>($this->supplierAddress)?SupplierAddressResource::collection($this->supplierAddress):[]
        ];
    }
}
