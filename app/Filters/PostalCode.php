<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostalCode extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('postal_code', $this->request->input($this->filterName()));
    }
}
