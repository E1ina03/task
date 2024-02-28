<?php

namespace App\Services;

use App\Exceptions\Exception;
use App\Models\User;
use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;;

class AuthServices
{
    public function __construct(protected AuthRepository $authRepository)
    {
    }
    public function authenticateUser($request)
    {
        Validator::make($request->all(),
            [
        'email' => 'required|string',
        'password' => 'required|string'
            ]
        );
        $user = $this->authRepository->findByEmail($request->email);


        if ($user && $user->enable == 1)
        {
            if (Hash::check( $request->password, $user->password))
            {
                $loginRes =
                    [
                    'token' => $user->createToken('Laravel password Grant Client')->accessToken
                    ];

                return  $loginRes;
            }
        }
        elseif ($user && $user->enable == 0)
        {
            $e = new Exception("This user is not available");

            return $e->getMessage();
        }
        else
        {
            $e = new Exception("User not found ");

            return $e->getMessage();
        }
    }
}
