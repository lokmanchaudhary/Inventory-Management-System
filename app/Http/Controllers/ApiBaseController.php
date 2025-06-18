<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

class ApiBaseController extends Controller
{
    // Method For Sending Success Response
    public function sendResponse($data, $message, $code = 200): JsonResponse
    {
        $response = [
            'success' => true,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($response,$code);
    }

    // Method For Sending Error Response
    public function sendError($error, $errorMessages = [], $code = 404): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (!empty($errorMessages))
        {
            $response['data'] = $errorMessages;
        }

        return response()->json($response,$code);
    }
}
