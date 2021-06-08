<?php

namespace App\Http\Controllers;

use App\Http\Resources\ImaQuotationResource;
use App\Models\ImaQuotation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ImaQuotationController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'problem_type' => 'required',
            'precision_one' => 'required',
            'intervention_date' => 'required',
            'start_time' => 'required',
            'cost' => 'required',
            'ima_user_id' => 'required|exists:ima_users,id',

        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return response()->json([
                'errors' => $errors
            ], 400);
        }

        $data = $request->all();
        $ima_quotation = ImaQuotation::create($data);

        return new ImaQuotationResource($ima_quotation);
    }
}
