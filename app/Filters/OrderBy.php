<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class OrderBy extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->orderBy(
            $this->request->input($this->filterName(), 'id'),
            $this->request->input('sort', 'desc')
        );
    }
}
