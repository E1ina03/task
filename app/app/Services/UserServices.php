<?php

namespace App\Services;

use App\Exceptions\Exception;
use App\Http\Resources\UserResource;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserServices
{
    public function createUser(array $data):UserResource
    {
        $validator = Validator::make($data,
            [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            ]
        );

        if ($validator->fails())
        {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $userData =
            [
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => bcrypt($data['password'])
            ];

        $user = User::query()->create($userData);

        return new  UserResource($user);
    }

    public function deleteUser(User $user): void
    {
        $user->delete();
    }
    public function updateUser(User $user, array $data):string
    {
        try {
            $validator = Validator::make($data,
                [
                'name' => 'required|string|max:255',
                'email' => 'required|email|email',
                ]
            );

            if ($validator->fails())
            {
                throw new InvalidArgumentException($validator->errors()->first());
            }

            $userData = [
                "name" => $data['name'],
                "email" => $data['email'],
            ];

            $existUser = User::query()->where('email', $userData['email'])->first();

            if ($existUser)
            {
                $e = new Exception('User with that email already exists');

                return $e->getMessage();
            }
            $user->update(
                [
                'name' => $userData['name'],
                'email' => $userData['email'],
                ]
            );

            $e = new Exception('Successful user update');

            return $e->getMessage();
        }
        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
    public function getUserWithProducts(User $user):User
    {
        $user->load('products');

        return $user;
    }

}
