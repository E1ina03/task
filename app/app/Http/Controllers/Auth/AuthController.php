<?php

declare(strict_types=1);

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Services\AuthServices;
use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;

class AuthController extends Controller
{
    public function __construct(protected AuthServices $authService)
    {
    }

    public function login(Request $request): LoginResource
    {
        try {
            $credentials = $this->authService->authenticateUser($request);

            if (isset($credentials['token'])) {
                return new LoginResource($credentials);
            } else {
                $error = response(
                    [
                        'message' => $credentials
                    ],
                    422
                );

                return new LoginResource($error);
            }
        } catch (\Exception $e) {
            $error = response(
                [
                    'message' => $e->getMessage()
                ],
                422
            );

            return new LoginResource($error);
        }
    }
}
