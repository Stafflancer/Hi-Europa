<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImaUserResource;
use App\Models\ImaUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImaUserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name'    => 'required',
            'last_name'     => 'required',
            'phone_number'  => 'required',
            'email'         => 'required|string|email|max:100',
            'title'         => 'required',
            'postal_code'   => 'required',
            'prospect_type' => 'required',
        ]);


        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'errors' => $errors
            ], 400);
        }

        $data = $request->all();

        $ima_user = ImaUser::where('email', $data['email'])->first();

        if ($ima_user) {
            return new ImaUserResource($ima_user);
        }

        $ima_user = ImaUser::create($data);

        return new ImaUserResource($ima_user);
    }


}
