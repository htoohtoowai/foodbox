<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupplierAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' =>$this->id,
            'address' => changeLanguage($request, $this->address_en, $this->address_mm),
            'phone' =>$this->phone,
            'towns'=>new TownResource($this->town)
        ];
    }
}
