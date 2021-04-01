<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\ContractResource;
use App\Models\Contract;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $contracts = Contract::orderBy('id', 'desc')->with('wakam_service', 'ima_service');

        if ($request->has('service') && $request->input('service') === 'ima') {
            $contracts->whereHas('ima_service', function ($query) {
                $query->where('id', '>', 0);
            });
        }

        if ($request->has('service') && $request->input('service') === 'wakam') {
            $contracts->whereHas('wakam_service', function ($query) {
                $query->where('id', '>', 0);
            });
        }

        $page = $request->input('page') ? : 1;
        $take = $request->input('count') ? : 10;
        $count = $contracts->count();

        if ($page) {
            $skip = $take * ($page - 1);
            $contracts = $contracts->take($take)->skip($skip);
        } else {
            $contracts = $contracts->take($take)->skip(0);
        }

        return response()->json([
            'data' =>  ContractResource::collection($contracts->get()),
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
