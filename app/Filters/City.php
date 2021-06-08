<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class City extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('city', $this->request->input($this->filterName()));
    }
}
