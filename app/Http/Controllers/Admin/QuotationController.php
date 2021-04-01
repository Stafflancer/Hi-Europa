<?php

namespace App\Http\Controllers\Admin;

use App\Http\Resources\QuotationResource;
use App\Models\Quotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class QuotationController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $quotations = Quotation::orderBy('id', 'desc')->with('wakam_service', 'ima_service');

        if ($request->has('service') && $request->input('service') === 'ima') {
            $quotations->whereHas('ima_service', function ($query) {
                $query->where('id', '>', 0);
            });
        }

        if ($request->has('service') && $request->input('service') === 'wakam') {
            $quotations->whereHas('wakam_service', function ($query) {
                $query->where('id', '>', 0);
            });
        }

        $page = $request->input('page') ? : 1;
        $take = $request->input('count') ? : 10;
        $count = $quotations->count();

        if ($page) {
            $skip = $take * ($page - 1);
            $quotations = $quotations->take($take)->skip($skip);
        } else {
            $quotations = $quotations->take($take)->skip(0);
        }
        return response()->json([
            'data' =>  QuotationResource::collection($quotations->get()),
            'pagination'=>[
                'count_pages' => ceil($count / $take),
                'count' => $count
            ]
        ], 200);
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
            'data' => $quotation
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
