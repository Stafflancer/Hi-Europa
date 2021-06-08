<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProspectResource;
use App\Models\Prospect;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProspectController extends Controller
{
    /**
     * @api {get} /api/admin/prospect Get Prospects
     * @apiVersion 0.1.0
     * @apiName GetProspects
     * @apiGroup Wakam
     *
     * @apiHeader {String} Authorization="Bearer TOKEN" Authorization "Bearer TOKEN"
     * @apiHeader {String} Accept="application/json"    Accept Json
     * @apiHeader {String} Content-Type="application/json"    Content-Type Json"
     *
     * @apiParam {Number}   [id]    Filter by id
     * @apiParam {Number}   [contract_id]    Filter by contract_id
     * @apiParam {String="id"}   order_by          Results Order By
     * @apiParam {String="desc", "asc"}   order             Results Order.
     * @apiParam {Number}   [page=1]          Current Page.
     * @apiParam {Number}   [per_page=15]     Items Per Page.
     * @apiParam {Number}   [count=15]        Same as per_page, deprecated
     * @apiExample Example usage:
     * curl -H "Authorization: Bearer $TOKEN" -H "Accept: application/json" "http://localhost:8000/api/admin/prospect"
     */
    public function index(Request $request)
    {
        $data = $this->pipelineQuery(
            Prospect::with('contract.user'),
            Prospect::PIPES,
            [],
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
     * @return ProspectResource
     */
    public function show($id)
    {
        $prospect = Prospect::find($id);

        return new  ProspectResource($prospect->load('contract.user'));
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
