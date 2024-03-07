<?php

declare(strict_types=1);

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {

        });
    }

    public function render($request, Throwable $e)
    {
        dd($e);
        if ($e instanceof AuthenticationException) {
            return response()->json([
               'success' => false,
               'message' => 'Unauthenticated',
            ], 401);
        }
        else {
            return response()->json([
                'success' => false,
                'message' => 'Non-admin users do not have access to these requests',
            ], 403);
        }
    }
}
