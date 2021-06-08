<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     *  function pipelineQuery
     *
     * @param Builder $query
     * @param array $pipes
     * @param array $select
     * @param boolean $paginate
     * @param integer $perPage
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator | \Illuminate\Support\Collection
     */
    protected function pipelineQuery(
        Builder $query,
        array $pipes = [],
        array $select = [],
        bool $paginate = true,
        int $perPage = 10
    ) {
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = app(Pipeline::class)
            ->send($query)
            ->through($pipes)
            ->thenReturn();

        if (count($select)) {
            $query->select(DB::raw(join(',', $select)));
        }
        if ($paginate) {
            return $query->paginate($perPage);
        }

        return $query->get();
    }
}
