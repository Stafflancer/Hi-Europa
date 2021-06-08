<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class UserId extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('user_id', $this->request->input($this->filterName()));
    }
}
