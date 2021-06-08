<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class FirstName extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('first_name', $this->request->input($this->filterName()));
    }
}
