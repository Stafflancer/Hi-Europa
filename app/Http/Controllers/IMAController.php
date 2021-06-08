<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class IMAController extends Controller
{
    public function __construct()
    {
        $this->checkEnvs();
    }

    public function token()
    {
        try {
            return Http::withBasicAuth(env('IMA_USERNAME', ''), env('IMA_PASSWORD', ''))->post(
                env('IMA_API_BASE', '') . '/oauth/v2/accesstoken',
                [
                    'grant_type' => 'client_credentials',
                ]
            )->throw()->json();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => $th->getCode(),
                'message' => $th->getMessage(),
                'data' => $th->getTrace()
            ], $th->getCode());
        }
    }

    public function proxy(Request $request)
    {
        $validated = $request->validate([
            'dist' => ['required'],
            'options' => ['required', 'array'],
        ]);
        try {
            $token = $request->bearerToken();
            if (!$token) {
                throw new Exception('Token not found.');
            }
            $method = strtolower($request->method());
            $dist = substr($validated['dist'], 0, 1) === "/" ? $validated['dist'] : '/' . $validated['dist'];

            $client = Http::withToken($token)->withHeaders(['appKey' => env('IMA_APP_KEY')]);
            if ($method === 'post') {
                $response = $client->post(env('IMA_API_BASE', '') . $dist, $validated['options']);
            } else {
                $response = $client->get(env('IMA_API_BASE', '') . $dist, $validated['options']);
            }
            return $response->throw()->json();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 'proxy_request_failed',
                'message' => $th->getMessage(),
                'data' => $th->getTrace()
            ], JsonResponse::HTTP_SERVICE_UNAVAILABLE);
        }
    }

    public function checkEnvs()
    {
        if (is_null(env('IMA_USERNAME'))) {
            throw new Exception('env `IMA_USERNAME` not found');
        }
        if (is_null(env('IMA_PASSWORD'))) {
            throw new Exception('env `IMA_PASSWORD` not found');
        }

        if (is_null(env('IMA_API_BASE'))) {
            throw new Exception('env `IMA_API_BASE` not found');
        }

        if (is_null(env('IMA_APP_KEY'))) {
            throw new Exception('env `IMA_APP_KEY` not found');
        }
    }
}
