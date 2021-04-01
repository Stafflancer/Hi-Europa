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
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $users = User::orderBy('id', 'desc')->with('wakam_service', 'ima_service');
        if ($request->has('service') && $request->input('service') === 'ima') {
            $users->whereHas('ima_service', function ($query) {
                $query->where('id', '>', 0);
            });
        }

        if ($request->has('service') && $request->input('service') === 'wakam') {
            $users->whereHas('wakam_service', function ($query) {
                $query->where('id', '>', 0);
            });
        }

        $page = $request->input('page') ? : 1;
        $take = $request->input('count') ? : 10;
        $count = $users->count();

        if ($page) {
            $skip = $take * ($page - 1);
            $users = $users->take($take)->skip($skip);
        } else {
            $users = $users->take($take)->skip(0);
        }

        return response()->json([
            'data' =>  UserResource::collection($users->get()),
            'pagination'=>[
                'count_pages' => ceil($count / $take),
                'count' => $count
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
            'email' => 'required|email|unique:users,email,'.$id,
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
