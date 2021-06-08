<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{

    public function index(Request $request)
    {
        $admins = Admin::where('id', '!=', auth('admin')->id())->with('admin_role')->orderBy('id', 'desc');

        $page = $request->input('page') ?: 1;
        $take = $request->input('count') ?: 10;
        $count = $admins->count();

        if ($page) {
            $skip = $take * ($page - 1);
            $admins = $admins->take($take)->skip($skip);
        } else {
            $admins = $admins->take($take)->skip(0);
        }
        return response()->json([
            'data' => $admins->get(),
            'pagination' => [
                'count_pages' => ceil($count / $take),
                'count' => $count
            ]
        ], 200);
    }

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'  => 'required',
            'password'  => 'required',
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        return response()->json([
            'data' => $admin->load('admin_role')
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
            'name'  => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return response()->json([
            'data' => $admin->load('admin_role')
        ], 200);
    }

    /**
     * @api {post} /api/admin/login Admin Login
     * @apiVersion 0.1.0
     * @apiName AdminLogin
     * @apiGroup Admin
     *
     * @apiParam {String}   email       Email
     * @apiParam {String}   password    Password
     *
     * @apiParamExample {json} Request-Example:
     *     {
     *       "email": "christopher.akinboboye@it-consultis.com",
     *       "password": "9O6y%)I7)Ri7I4IxcxDE0)LC"
     *     }
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'    => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        if (!$token = auth('admin')->attempt($validator->validated())) {
            return response()->json([
                'error'   => 'incorrect_credentials',
                'message' => 'Incorrect email or password!'
            ], 500);
        }

        return response()->json($this->createNewToken($token), 200);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth('admin')->logout();

        return response()->json(
            ['message' => 'User successfully signed out'],
            200
        );
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile()
    {
        return response()->json(auth('admin')->user()->load('admin_role'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $admin = Admin::find($id);
        return response()->json([
            'data' =>$admin->load('admin_role')
        ], 200);
    }

    /**
     * @param $token
     *
     * @return array
     */
    protected function createNewToken($token)
    {
        return [
            'access_token' => $token,
            'token_type'   => 'Bearer',
            'user'         => auth('admin')->user()
        ];
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $admin = Admin::find($id);

        if ($admin) {
            $admin->delete();
            return response()->json([
                'message' => 'Admin delete successfully!'
            ], 200);
        }

        return response()->json([
            'message' => 'Admin not found!'
        ], 404);
    }
}
