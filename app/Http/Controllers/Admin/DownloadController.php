<?php

namespace App\Http\Controllers\Admin;

use App\Enums\DownloadAction;
use App\Http\Controllers\Controller;
use App\Rules\DownloadNonce;
use App\Rules\DownloadToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DownloadController extends Controller
{

    /**
     * @api {get} /api/download/v1/token Get validate token
     * @apiVersion 0.1.0
     * @apiName GetDownloadToken
     * @apiGroup Download
     *
     * @apiParam {String="get_ima_users","get_ima_quotations","get_wakam_prospects", "get_wakam_users", "get_wakam_quotations", "get_wakam_contracts"}    action    Download action.
     * @apiParam {Number} nonce     Current timestamp.
     */
    public function token(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => ['required', 'string', Rule::in(DownloadAction::values())],
            'nonce' => ['required', 'numeric'],
        ], [
            'action.in' => 'The `:attribute` must be one of the following types: ' . join(',', DownloadAction::values())
        ]);
        if ($validator->fails()) {
            return response()->json([
                'code' => 'validation_failed',
                "message" => "The given data was invalid.",
                'data' => $validator->errors()->all()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return response()->json([
            'code' => 'get_download_token_successfully',
            'message' => 'Get download token successfully',
            'data' => [
                'token' => base64_encode($this->getToken($request->input('action'), $request->input('nonce'))),
                'expire' => 7200
            ]
        ]);
    }

    /**
     * @api {get} /api/download/v1/download?action=$a&nonce=$b&token=$c Assemble Download Link
     * @apiVersion 0.1.0
     * @apiName AssembleDownloadLink
     * @apiDescription Open it in new tab
     * @apiGroup Download
     */
    public function download(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'action' => ['required', 'string'],
            'nonce' => ['required', 'numeric', new DownloadNonce],
            'token' => ['required', 'string', new DownloadToken($this->plainToken($request->all()))],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'code' => 'validation_failed',
                "message" => "The given data was invalid.",
                'data' => $validator->errors()->all()
            ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
        }

        return call_user_func(function ($args) {
            $filename = implode('_', $args);
            if (strpos($args['action'], 'get_ima_')  !== false) {
                $exportClassName = sprintf('\App\Exports\Ima\%sExport', ucfirst(str_replace('get_ima_', '', $args['action'])));
            } else {
                $exportClassName = sprintf('\App\Exports\Wakam\%sExport', ucfirst(str_replace('get_wakam_', '', $args['action'])));
            }
            return (new $exportClassName)->download($filename . '.csv', \Maatwebsite\Excel\Excel::CSV, $this->csvHeaders());
        }, $request->only('action', 'nonce'));
    }

    protected function csvHeaders()
    {
        return [
            'Content-Type' => 'text/csv',
        ];
    }

    protected function plainToken($data)
    {
        return $data['action'] . $data['nonce'] . env('JWT_SECRET');
    }
    protected function getToken($action, $nonce)
    {
        return Hash::make($action . $nonce . env('JWT_SECRET'));
    }
}
