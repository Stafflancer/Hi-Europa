<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use App\Models\User;
use App\Models\WakamService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuotationController extends Controller
{
    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) 
        {
            return response()->json($validator->errors(), 422);
        }

        $data = $request->all();
        $data['opt_in_hieuropa'] = 1;

        $quotation = Quotation::create($data);

        return response()->json([
            'data' => $quotation
        ],200);
    }
}
