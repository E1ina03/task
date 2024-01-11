<?php

namespace App\Services;

use App\Exceptions\Exception;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;;

class AuthServices
{
    public function authenticateUser($request)
    {
        Validator::make($request->all(),
            [
        'email' => 'required|string',
        'password' => 'required|string'
            ]
        );
        $user = User::query()->where('email', $request->email)->first();

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
            $e = new Exception("User not found");

            return $e->getMessage();
        }
    }
}
