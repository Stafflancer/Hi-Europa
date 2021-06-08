<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'      => 'required',
            'last_name'       => 'required',
            'postal_code'     => 'required',
            'email'           => 'required|string|email|max:100|unique:users,email',
            'residency_type' => 'required',
            'residence_type' => 'required',
            'floor' => 'required',
            'number_rooms' => 'required',
            'live_there_time' => 'required',
            'insured_time' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        $data['opt_in_hieuropa'] = 1;
        $data['got_insurance'] = 1;

        $user = User::create($data);

        return response()->json([
            'data' => new UserResource($user)
        ], 200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'string|email|max:100|unique:users,email',
        ]);

        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), 422);
        }

        $user = User::findOrFail($id);

        $user->update($request->all());

        return response()->json([
            'data' => new UserResource($user)
        ], 200);
    }
}
