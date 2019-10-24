<?php

namespace App\Utils;

trait JSONResponse
{
    // Success Json Response with no data
    public function success($message = "Operation Successful", $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
        ], $code);
    }


    // Success Json Response with data
    public function successWithData($data = [], $message = "Operation Successful", $code = 200)
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    // Error Json Response without data
    public function error($message = "Operation Failed", $code = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $code);
    }

    // Error Json Response without data
    public function errorWithData($data = [], $message = "Operation Failed",  $code = 400)
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    public function errorValidation($data = [], $message = "Validation Error" , $code = 422)
    {
        return response()->json([
            "message" => $message,
            'errors' => $data
        ], $code);
    }
}
