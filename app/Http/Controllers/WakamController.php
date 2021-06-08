<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WakamController extends Controller
{
    public function __construct()
    {
        $this->checkEnvs();
    }
    public function checkEnvs()
    {
        // WAKAM_API_BASE
        if (is_null(env('WAKAM_API_BASE'))) {
            throw new Exception('env `WAKAM_API_BASE` not found');
        }
        if (is_null(env('WAKAM_PARTNERSHIP_CODE'))) {
            throw new Exception('env `WAKAM_PARTNERSHIP_CODE` not found');
        }
        if (is_null(env('WAKAM_OCP_APIM_SUBSCRIPTION_KEY'))) {
            throw new Exception('env `WAKAM_OCP_APIM_SUBSCRIPTION_KEY` not found');
        }
    }

    public function proxy(Request $request)
    {
        $validated = $request->validate([
            'dist' => ['required'],
            'options' => ['required', 'array'],
        ]);

        try {
            $method = strtolower($request->method());
            $dist = substr($validated['dist'], 0, 1) === "/" ? $validated['dist'] : '/' . $validated['dist'];

            $client = Http::withHeaders([
                'PartnershipCode' => env('WAKAM_PARTNERSHIP_CODE'),
                'Ocp-Apim-Subscription-Key' => env('WAKAM_OCP_APIM_SUBSCRIPTION_KEY')
            ]);
            if ($method === 'post') {
                $response = $client->post(env('WAKAM_API_BASE', '') . $dist, $validated['options']);
            } else {
                $response = $client->get(env('WAKAM_API_BASE', '') . $dist, $validated['options']);
            }
            return $response->throw()->json();
        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'code' => 'proxy_request_failed',
                'message' => $th->getMessage(),
                'data' => $th->getTrace()
            ], JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }
    }
}
