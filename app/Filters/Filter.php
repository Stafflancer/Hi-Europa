<?php

namespace App\Filters;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

abstract class Filter
{
    protected $request;

    function __construct(Request $request)
    {
        $this->request = $request;
    }
    /**
     * Handle the filter and return the builder.
     *
     * @param Builder $builder
     * @param Closure $next
     * @return void
     */
    public function handle(Builder $builder, Closure $next)
    {
        if (!$this->request->has($this->filterName()) || $this->request->input($this->filterName(), '') === '') {
            return $next($builder);
        }
        return $this->applyFilters($next($builder));
    }

    /**
     * apply Filters
     *
     * @param Builder $builder
     * @return void
     */
    protected abstract function applyFilters(Builder $builder): Builder;

    protected function filterName()
    {
        return Str::snake(class_basename($this));
    }
}
