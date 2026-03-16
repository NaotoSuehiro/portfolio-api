<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            if (! $e instanceof BusinessLogicException) {
                Log::error($e->getMessage(), [
                    'exception' => $e,
                ]);
            }
        });
    }

    public function render($request, Throwable $e)
    {
        if ($e instanceof BusinessLogicException) {
            return response()->json([
                'error' => [
                    'code' => $e->getErrorCode(),
                    'message' => $e->getErrorMessage(),
                ],
            ], $e->getHttpStatus());
        }

        if ($request->expectsJson()) {
            return response()->json([
                'error' => [
                    'code' => 'SYSTEM_ERROR',
                    'message' => 'An internal error occurred.',
                ],
            ], 500);
        }

        return parent::render($request, $e);
    }
}
