<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponseTrait
{
    /**
     * Return a success response.
     *
     * @param  mixed  $data
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public function successResponse($data, $message = 'Request successful', $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    /**
     * Return an error response.
     *
     * @param  string  $message
     * @param  mixed  $data
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public function errorResponse($message, $data = [], $statusCode = 400): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'data' => $data,
            'message' => $message
        ], $statusCode);
    }

    /**
     * Return a validation error response.
     *
     * @param  mixed  $errors
     * @param  string  $message
     * @param  int  $statusCode
     * @return JsonResponse
     */
    public function validationErrorResponse($errors, $message = 'Validation error', $statusCode = 422): JsonResponse
    {
        return response()->json([
            'status' => 'error',
            'data' => $errors,
            'message' => $message
        ], $statusCode);
    }
}
