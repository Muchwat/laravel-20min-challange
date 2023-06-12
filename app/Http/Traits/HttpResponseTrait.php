<?php

namespace App\Http\Traits;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

trait HttpResponseTrait 
{   
    
    /**
     * Summary of successResponse
     * @param mixed $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    function successResponse(array $data = [], string $message): JsonResponse {
        return response()->json([
            'success' => true,
            'status'=> 'success',
            'message' => $message,
            'data' => $data,
        ], Response::HTTP_OK);
    }

   
    /**
     * Summary of errorResponse
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    function errorResponse(string $message): JsonResponse {
        return response()->json([
            'success' => false,
            'status'=> 'error',
            'message' => $message,
        ], Response::HTTP_OK);
    }


    /**
     * Summary of notFoundResponse
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    function notFoundResponse(string $message): JsonResponse {
        return response()->json([
            'success' => false,
            'status'=> 'warning',
            'message' => $message,
        ], Response::HTTP_NOT_FOUND);
    }
}
