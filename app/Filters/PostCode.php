<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PostCode extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('post_code', $this->request->input($this->filterName()));
    }
}
