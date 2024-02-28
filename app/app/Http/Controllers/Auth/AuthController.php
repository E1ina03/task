<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoginResource;
use App\Services\AuthServices;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthServices $authService) {}

    public function login(Request $request):LoginResource
    {

        try {
            $credentials = $this->authService->authenticateUser($request);

            if (isset($credentials['token']))
            {
                return new LoginResource($credentials);
            }
            else
            {
                $error = response(
                    [
                        'message' => $credentials
                    ], 422);

                return new LoginResource($error);
            }
        } catch (\Exception $e)
        {
            $error = response(
                [
                    'message' => $e->getMessage()
                ], 422);

            return new LoginResource($error);
        }
    }
}
