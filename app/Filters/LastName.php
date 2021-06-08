<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class LastName extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('last_name', $this->request->input($this->filterName()));
    }
}
