<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StateRegionResource extends JsonResource
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
            'srPcode' =>$this->sr_pcode,
            'name' => changeLanguage($request, $this->name_en, $this->name_mm),
        ];
    }
}
