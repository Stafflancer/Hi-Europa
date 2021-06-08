<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImaUserResource;
use App\Http\Resources\InterventionResource;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InterventionController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address'    => 'required',
            'attendance_person'    => 'required',
            'ima_user_id'    => 'required',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'errors' => $errors
            ], 400);
        }

        $data = $request->all();

        $Intervention = Intervention::create($data);

        return new InterventionResource($Intervention);

    }
}
