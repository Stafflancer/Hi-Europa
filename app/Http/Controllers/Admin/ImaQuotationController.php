<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ImaQuotationOrderByAction;
use App\Enums\OrderAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImaQuotationResource;
use App\Models\ImaQuotation;
use Illuminate\Validation\Rule;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class ImaQuotationController extends Controller
{
    /**
     * @api {get} /api/admin/ima-quotation Get IMA Quotations
     * @apiVersion 0.1.0
     * @apiName GerIMAQuotations
     * @apiGroup IMA
     *
     * @apiHeader {String} Authorization="Bearer TOKEN" Authorization "Bearer TOKEN"
     * @apiHeader {String} Accept="application/json"    Accept Json
     * @apiHeader {String} Content-Type="application/json"    Content-Type Json"
     *
     * @apiParam {Number}   [id]          Filter by id
     * @apiParam {Number}   [ima_user_id]          Filter by ima_user_id
     * @apiParam {String="id"}   order_by          Results Order By
     * @apiParam {String="desc", "asc"}   order             Results Order.
     * @apiParam {Number}   [page=1]          Current Page.
     * @apiParam {Number}   [per_page=15]     Items Per Page.
     * @apiParam {Number}   [count=15]        Same as per_page, deprecated.
     *
     * @apiExample Example usage:
     * curl -H "Authorization: Bearer $TOKEN" http://localhost:8000/api/admin/ima-quotation
     */
    public function index(Request $request)
    {
        $request->validate([
            'id' => ['numeric'],
            'user_id' => ['numeric'],
            'order_by' => [Rule::in(ImaQuotationOrderByAction::values())],
            'order' => [Rule::in(OrderAction::values())],
        ], [
            'order_by.in' => 'The `:attribute` must be in: ' . join(',', ImaQuotationOrderByAction::values()),
            'order.in' => 'The `:attribute` must be in: ' . join(',', OrderAction::values()),
        ]);

        /** @var \Illuminate\Database\Query\Builder $query */
        $query = app(Pipeline::class)
            ->send(ImaQuotation::query()->with('user'))
            ->through(ImaQuotation::PIPES)
            ->thenReturn();
        $quotations = $query->paginate($request->input('per_page', $request->input('count', 10)));
        $perPage = $quotations->perPage();
        $total = $quotations->total();

        return response()->json([
            'data' =>  $quotations->items(),
            'pagination' => [
                'count_pages' => ceil($total / $perPage),
                'current_page' => $quotations->currentPage(),
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
     * @return ImaQuotationResource
     */
    public function show($id)
    {
        $quotation = ImaQuotation::where('id', $id)->with('user')->first();

        return new ImaQuotationResource($quotation);
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
