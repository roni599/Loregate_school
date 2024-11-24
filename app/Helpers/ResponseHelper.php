<?php

namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function success($data = [], $message = 'Success', $code = 200): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data,
        ], $code);
    }

    // General error response
    public static function error($message = 'Error', $code = 400, $errors = []): JsonResponse
    {
        return response()->json([
            'status' => false,
            'message' => $message,
            'errors' => $errors,
        ], $code);
    }

    public static function requestData($request): JsonResponse
    {
        return response()->json([
            'status' => true,
            'message' => 'Request Data Retrieved Successfully',
            'data' => $request->all(),
        ], 200);
    }

    // 400 Bad Request
    public static function badRequest($message = 'Bad Request', $errors = []): JsonResponse
    {
        return self::error($message, 400, $errors);
    }

    // 401 Unauthorized
    public static function unauthorized($message = 'Unauthorized', $errors = []): JsonResponse
    {
        return self::error($message, 401, $errors);
    }

    // 403 Forbidden
    public static function forbidden($message = 'Forbidden', $errors = []): JsonResponse
    {
        return self::error($message, 403, $errors);
    }

    // 404 Not Found
    public static function notFound($message = 'Not Found', $errors = []): JsonResponse
    {
        return self::error($message, 404, $errors);
    }

    // 422 Unprocessable Entity (validation errors)
    public static function unprocessableEntity($message = 'Unprocessable Entity', $errors = []): JsonResponse
    {
        return self::error($message, 422, $errors);
    }

    // 500 Internal Server Error
    public static function internalServerError($message = 'Internal Server Error', $errors = []): JsonResponse
    {
        return self::error($message, 500, $errors);
    }

    // 503 Service Unavailable
    public static function serviceUnavailable($message = 'Service Unavailable', $errors = []): JsonResponse
    {
        return self::error($message, 503, $errors);
    }
}
