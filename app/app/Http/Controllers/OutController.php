<?php

namespace App\Http\Controllers;

use App\Http\Resources\LoginResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class OutController extends Controller
{

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);


        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }
        $user = User::query()->where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {

                $loginRes = [
                    'token' => $user->createToken('Laravel password Grant Client')->accessToken
                ];

                return new LoginResource($loginRes);
            } else {
                $response = ["message" => "Password mismatch"];
                return response($response, 422);
            }
        } else {
            $response = ["message" => "User does not exist"];
            return response($response, 422);
        }
    }
}
