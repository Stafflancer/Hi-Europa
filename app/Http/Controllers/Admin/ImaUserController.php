<?php

namespace App\Http\Controllers\Admin;

use App\Enums\ImaUserOrderByAction;
use App\Enums\OrderAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\ImaUserResource;
use App\Models\ImaUser;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Pipeline\Pipeline;

class ImaUserController extends Controller
{
    /**
     * @api {get} /api/admin/ima-user Get IMA Users
     * @apiVersion 0.1.0
     * @apiName GerIMAUsers
     * @apiGroup IMA
     *
     * @apiHeader {String} Authorization="Bearer TOKEN" Authorization "Bearer TOKEN"
     * @apiHeader {String} Accept="application/json"    Accept Json
     * @apiHeader {String} Content-Type="application/json"    Content-Type Json
     *
     * @apiHeaderExample {json} Header-Example:
     *  {
     *      "Authorization": "Bearer TOKEN",
     *      "Content-Type": "application/json",
     *      "Accept": "application/json"
     *  }
     *
     * @apiParam {Number}   [id]            Filter by id
     * @apiParam {String}   [first_name]    Filter by first_name
     * @apiParam {String}   [last_name]    Filter by last_name
     * @apiParam {String}   [email]    Filter by email
     * @apiParam {String}   [phone_number]    Filter by phone_number
     * @apiParam {Number}   [postal_code]    Filter by postal_code
     * @apiParam {String}   [city]    Filter by city
     * @apiParam {String="id"}   order_by          Results Order By
     * @apiParam {String="desc", "asc"}   order             Results Order.
     * @apiParam {Number}   [page=1]          Current Page.
     * @apiParam {Number}   [per_page=15]     Items Per Page.
     * @apiParam {Number}   [count=15]        Same as per_page, deprecated
     *
     * @apiExample Example usage:
     * curl -H 'Accept: application/json' -H "Authorization: Bearer $TOKEN" http://localhost:8000/api/admin/ima-user
     */
    public function index(Request $request)
    {
        $request->validate([
            'id' => ['numeric'],
            'order_by' => [Rule::in(ImaUserOrderByAction::values())],
            'order' => [Rule::in(OrderAction::values())],
        ], [
            'order_by.in' => 'The `:attribute` must be in: ' . join(',', ImaUserOrderByAction::values()),
            'order.in' => 'The `:attribute` must be in: ' . join(',', OrderAction::values()),
        ]);

        /** @var \Illuminate\Database\Query\Builder $query */
        $query = app(Pipeline::class)
            ->send(ImaUser::query())
            ->through(ImaUser::PIPES)
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
     * @param $id
     *
     * @return ImaUserResource
     */
    public function show($id)
    {
        $user = ImaUser::find($id);

        return new ImaUserResource($user);
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
