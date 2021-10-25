<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ApiResponseController extends Controller
{
    public function successResponse($data, $code = 200, $msg = ''): \Illuminate\Http\JsonResponse
    {
        $response = [];
        if (!is_null($data)) {
            $response['data'] = $data;
        }
        if (!is_null($msg)) {
            $response['msg'] = $msg;
        }
        if (!is_null($code)) {
            $response['code'] = $code;
        }
        return response()->json($response);
    }
    public function errorResponse($data, $code = 500, $msg = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json(["data" => $data, "code" => $code, "msg" => $msg]);
    }
}
