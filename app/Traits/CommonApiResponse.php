<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait CommonApiResponse
{
    /**
     * Common API response for controllers
     * @param bool $status
     * @param $message
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    public function commonResponse(bool $status, $message, $data, int $code): JsonResponse
    {
        return response()->json([
            'success' => $status,
            'message' => $message,
            'result'    => $data
        ], $code);
    }

    public function bookingResponse(int $code, string $message, string $dataName, $data, int $status): JsonResponse
    {
        return response()->json([
            'response' => [
                'code' => [
                    'key' => $code,
                    'message' =>  $message,
                ],
                $dataName => $data,
            ],
            'status' => $status
        ], $status);
    }

    public function authResponse(int $code, string $message, int $status): JsonResponse
    {
        return response()->json([
            'response' => [
                'code' => [
                    'key' => $code,
                    'message' =>  $message,
                ],
            ],
            'status' => $status
        ], $status);
    }
}
