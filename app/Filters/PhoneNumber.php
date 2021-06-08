<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class PhoneNumber extends Filter
{
    protected function applyFilters(Builder $builder): Builder
    {
        return $builder->where('phone_number', $this->request->input($this->filterName()));
    }
}
