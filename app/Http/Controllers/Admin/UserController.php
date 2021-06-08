<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @api {get} /api/admin/user Get Users
     * @apiVersion 0.1.0
     * @apiName GetUsers
     * @apiGroup Wakam
     *
     * @apiHeader {String} authorization="Bearer TOKEN" Authorization "Bearer TOKEN"
     *
     * @apiParam {Number}   [page=1]          Current Page.
     * @apiParam {Number}   [per_page=15]     Items Per Page.
     * @apiParam {Number}   [count=15]        Same as per_page, deprecated.
     * @apiExample Example usage:
     * curl -H "Authorization: Bearer $TOKEN" -H "Accept: application/json" http://localhost:8000/api/admin/user
     */
    public function index(Request $request)
    {
        $data = $this->pipelineQuery(
            User::with('quotation', 'contract', 'resiliation'),
            User::PIPES,
            [],
            true,
            $request->input('per_page', $request->input('count', 10))
        );

        return response()->json([
            'data' =>  $data->items(),
            'pagination' => [
                'count' => $data->total(),
                'count_pages' => ceil($data->total() / $data->perPage()),
            ]
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|min:6',
            'password_confirmation' => 'required_with:password|same:password|min:6'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'errors' => $errors
            ], 400);
        }

        $data = $request->except('password_confirmation');
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        return response()->json([
            'data' => new UserResource($user)
        ], 200);
    }

    /**
     * @param $id
     *
     * @return UserResource
     */
    public function show($id)
    {
        $user = User::findOrFail($id);

        return new UserResource($user);
    }

    /**
     * @param Request $request
     * @param         $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'sometimes|required|string|min:6',
            'password_confirmation' => 'sometimes|required_with:password|same:password|min:6'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'errors' => $errors
            ], 400);
        }

        $user = User::findOrFail($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->phone_number = $request->phone_number;
        $user->email = $request->email;
        $user->save();

        return response()->json([
            'data' => new UserResource($user)
        ], 200);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User has been deleted successfully!'
        ], 200);
    }
}
