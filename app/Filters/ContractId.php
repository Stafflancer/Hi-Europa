<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ContractId extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('contract_id', $this->request->input($this->filterName()));
    }
}
