<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    // response successful
    public function sendResponse($result, $message, $code = 200) 
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message' => $message,
            'status' => $code
        ];

        return response()->json($response, 200);
    }

    // response fail
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'status' => $code
        ];

        if(!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
