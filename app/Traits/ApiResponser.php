<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use function Sentry\captureException;

trait ApiResponser
{
    public function successResponse($data, $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json(['data' => $data, 'code' => $code], $code);
    }

    public function errorResponseException(
        Exception $exception,
        $message = '',
        $code = ''
    ): JsonResponse {
        captureException($exception);

        $message = $message ?: $exception->getMessage();
        $code = $code ?: $exception->getCode();

        return $this->errorResponse($message, $code);
    }

    public function errorResponse($message, $code): JsonResponse
    {
        logs()->info('USER SERVICE: '.static::class.' ('.$code.') '.json_encode($message, JSON_THROW_ON_ERROR));

        return response()->json(['error' => $message, 'code' => $code]);
    }

    public function errorMessage($message, $code)
    {
        return response($message, $code)->header('Content-Type', 'application/json');
    }
}
