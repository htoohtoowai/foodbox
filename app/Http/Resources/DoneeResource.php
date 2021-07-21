<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DoneeResource extends JsonResource
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
            'item' =>new CategoryItemResource($this->categoryItem),
            'member' =>[
                'id'=>$this->member->id,
                'name'=>$this->member->name,
            ],
            'qty'=>$this->qty,
            'unit'=>new UnitResource($this->unit),
            'status'=>$this->status,
            'notes'=>$this->notes,
        ];
    }
}
