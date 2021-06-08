<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ContractOrderByAction;
use App\Enums\OrderAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Validation\Rule;

class ContractController extends Controller
{
    /**
     * @api {get} /api/admin/contract Get Contracts
     * @apiVersion 0.1.0
     * @apiName GetContracts
     * @apiGroup Wakam
     *
     * @apiHeader {String} Authorization="Bearer TOKEN" Authorization "Bearer TOKEN"
     * @apiHeader {String} Accept="application/json"    Accept Json
     * @apiHeader {String} Content-Type="application/json"    Content-Type Json"
     *
     * @apiParam {Number}   [id]            Filter by id
     * @apiParam {Number}   [user_id]          Filter by user_id
     * @apiParam {Number}   [post_code]    Filter by post_code
     * @apiParam {String}   [city]    Filter by city
     * @apiParam {String="id"}   order_by          Results Order By
     * @apiParam {String="desc", "asc"}   order             Results Order.
     * @apiParam {Number}   [page=1]          Current Page.
     * @apiParam {Number}   [per_page=15]     Items Per Page.
     * @apiParam {Number}   [count=15]        Same as per_page, deprecated
     *
     * @apiExample Example usage:
     * curl -H "Authorization: Bearer $TOKEN" http://localhost:8000/api/admin/contract
     */
    public function index(Request $request)
    {
        $request->validate([
            'id' => ['numeric'],
            'user_id' => ['numeric'],
            'post_code' => ['numeric'],
            'order_by' => [Rule::in(ContractOrderByAction::values())],
            'order' => [Rule::in(OrderAction::values())],
        ], [
            'order_by.in' => 'The `:attribute` must be in: ' . join(',', ContractOrderByAction::values()),
            'order.in' => 'The `:attribute` must be in: ' . join(',', OrderAction::values()),
        ]);
        /** @var \Illuminate\Database\Query\Builder $query */
        $query = app(Pipeline::class)
            ->send(Contract::query()->with('user.quotation', 'residents'))
            ->through(Contract::PIPES)
            ->thenReturn();
        $data = $query->paginate($request->input('per_page', $request->input('count', 10)));
        $perPage = $data->perPage();
        $total = $data->total();

        return response()->json([
            'data' =>  $data->items(),
            'pagination' => [
                'count_pages' => ceil($total / $perPage),
                'current_page' => $data->currentPage(),
                'count' => $total
            ]
        ], JsonResponse::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param $id
     *
     * @return ContractResource
     */
    public function show($id)
    {
        $contract = Contract::find($id);
        return new ContractResource($contract->load('user.quotation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
