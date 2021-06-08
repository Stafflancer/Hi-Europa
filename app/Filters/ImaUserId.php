<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class ImaUserId extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('ima_user_id', $this->request->input($this->filterName()));
    }
}
