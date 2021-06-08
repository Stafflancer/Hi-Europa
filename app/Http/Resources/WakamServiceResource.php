<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WakamServiceResource extends JsonResource
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
            'quotation' =>$this->wakam_quotation->name,
            'insurance' =>$this->wakam_insurance->name,
            'personal_info' =>$this->wakam_user,
            'contract' => [
                'stored_id' => $this->wakam_contract->stored_id,
                'number' => $this->wakam_contract->number
            ],
            'owner' =>$this->user,
            'updated_at' =>$this->updated_at,
            'created_at' =>$this->created_at,
        ];
    }
}
