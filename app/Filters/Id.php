<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class Id extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('id', $this->request->input($this->filterName()));
    }
}
