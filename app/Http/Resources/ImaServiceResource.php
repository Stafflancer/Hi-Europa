<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImaServiceResource extends JsonResource
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
            'billing_address' =>$this->ima_billing_address,
            'intervention_address' =>$this->ima_intervention_address,
            'quotation' =>$this->ima_quotation->name,
            'user' =>$this->ima_user,
            'contract' => [
                'stored_id' => $this->ima_contract->stored_id,
                'number' => $this->ima_contract->number
            ],
            'owner' =>$this->user,
            'updated_at' =>$this->updated_at,
            'created_at' =>$this->created_at,
        ];
    }
}
