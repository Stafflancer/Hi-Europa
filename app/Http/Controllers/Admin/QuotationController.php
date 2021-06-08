<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderAction;
use App\Enums\QuotationOrderByAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\QuotationResource;
use App\Models\Quotation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;

class QuotationController extends Controller
{
    /**
     * @api {get} /api/admin/quotation Get Quotation
     * @apiVersion 0.1.0
     * @apiName GetQuotation
     * @apiGroup Wakam
     *
     * @apiHeader {String} Authorization="Bearer TOKEN" Authorization "Bearer TOKEN"
     * @apiHeader {String} Accept="application/json"    Accept Json
     * @apiHeader {String} Content-Type="application/json"    Content-Type Json"
     *
     * @apiParam {Number}   [id]          Filter by id
     * @apiParam {Number}   [user_id]          Filter by user_id
     * @apiParam {String}   [postal_code]          Filter by postal_code
     * @apiParam {String="id"}   order_by          Results Order By
     * @apiParam {String="desc", "asc"}   order             Results Order.
     * @apiParam {Number}   [page=1]          Current Page.
     * @apiParam {Number}   [per_page=15]     Items Per Page.
     * @apiParam {Number}   [count=15]        Same as per_page, deprecated.
     *
     * @apiExample Example usage:
     * curl -H "Authorization: Bearer $TOKEN" http://localhost:8000/api/admin/quotation
     */
    public function index(Request $request)
    {
        $request->validate(
            [
                'id' => ['numeric'],
                'user_id' => ['numeric'],
                'order_by' => [Rule::in(QuotationOrderByAction::values())],
                'order' => [Rule::in(OrderAction::values())],
            ],
            [
                'order_by.in' => 'The `:attribute` must be in: ' . join(',', QuotationOrderByAction::values()),
                'order.in' => 'The `:attribute` must be in: ' . join(',', OrderAction::values()),
            ]
        );

        $columns  = Schema::getColumnListing((new Quotation)->getTable());
        $newColumns = array_replace($columns, [array_search('room', $columns) => 'room+library+living_room+mezzanine as room']);

        $data = $this->pipelineQuery(
            Quotation::query()->with('user', 'contract'),
            Quotation::PIPES,
            $newColumns,
            true,
            $request->input('per_page', $request->input('count', 10))
        );
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
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $quotation = Quotation::create($request->all());

        return response()->json([
            'data' => new QuotationResource($quotation)
        ], 200);
    }

    /**
     * Display the specified resource.
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $quotation = Quotation::find($id);

        return response()->json([
            'data' => new QuotationResource($quotation)
        ], 200);
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
