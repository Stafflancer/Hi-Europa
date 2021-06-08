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
            'id'                         => $this->id,
            'postal_code'                => $this->postal_code,
            'type_accommodation'         => $this->type_accommodation,
            'prospect_type'              => $this->prospect_type,
            'type_residence'             => $this->type_residence,
            'apartment_floor'            => $this->apartment_floor,
            'user'                       => $this->user,
            'contract'                   => $this->contract,
            'apartment_surface'          => $this->apartment_surface,
            'room'                       => ($this->room + $this->living_room + $this->library + $this->mezzanine),
            'insured'                    => $this->insured,
            'termination'                => $this->termination,
            'franchise'                  => $this->franchise,
            'furniture_capital'          => $this->furniture_capital,
            'furniture_two_years_old'    => $this->furniture_two_years_old,
            'total_value_furniture_400'  => $this->total_value_furniture_400,
            'total_value_furniture_1800' => $this->total_value_furniture_1800,
            'estimated_coverage'         => $this->estimated_coverage,
            'option_glass'               => $this->option_glass,
            'option_thief'               => $this->option_thief,
            'option_mobile'              => $this->option_mobile,
            'protect_legal'              => $this->protect_legal,
            'school_insurance'           => $this->school_insurance,
            'dependencies'               => $this->dependencies,
            'cost_month'                 => $this->dependencies,
            'updated_at'                 => $this->updated_at,
            'created_at'                 => $this->created_at,
        ];
    }
}
