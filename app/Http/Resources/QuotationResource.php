<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuotationResource extends JsonResource
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
            'name' =>$this->name,
            'service_name' =>$this->service_name,
            'service' => $this->service,
            'ima_service' =>$this->ima_service,
            'updated_at' =>$this->updated_at,
            'created_at' =>$this->created_at,
        ];
    }
}
