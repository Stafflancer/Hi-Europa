<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class Email extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('email', $this->request->input($this->filterName()));
    }
}
