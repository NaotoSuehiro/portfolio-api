<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;
use Throwable;
use App\Exceptions\DatabaseOperationException;
use App\Exceptions\DomainException;
use App\Exceptions\ValidationException;
use App\Exceptions\ExternalApiException;
use App\Exceptions\ResourceNotFoundException;
use Illuminate\Support\Facades\Log;

class ExceptionHandler
{
    public static function handleException(Throwable $e): JsonResponse
    {

        if ($e instanceof BusinessLogicException) {
            return self::handleBusinessException($e);
        }

        Log::error('An internal error occurred.', [
            'code' => 'SYSTEM_ERROR',
            'message' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ]);

        return response()->json([
            'error' => [
                'code' => 'SYSTEM_ERROR',
                'message' => 'An internal error occurred.'
            ]
        ], 500);
    }

    private static function handleBusinessException(BusinessLogicException $e): JsonResponse
    {
        $status_code = self::getHttpStatusCode($e);

        return response()->json([
            'error' => [
                'code' => $e->getErrorCode(),
                'message' => $e->getErrorMessage()
            ]
        ], $status_code);
    }

    private static function getHttpStatusCode(BusinessLogicException $e): int
    {
        return match (get_class($e)) {
            DatabaseOperationException::class => 500,
            ExternalApiException::class => 500,
            DomainException::class => 400,
            ValidationException::class => 422,
            ResourceNotFoundException::class => 404,
            default => 500,
        };
    }
}
