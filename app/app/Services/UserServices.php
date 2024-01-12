<?php

namespace App\Services;

use App\Exceptions\Exception;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserServices
{
    public function __construct(protected UserRepository $userRepository)
    {
    }
    public function createUser(Request $request):User
    {
        $data =$request->toArray();

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

        $user = $this->userRepository->create($userData);

        return $user;
    }

    public function deleteUser(User $user): void
    {
        $this->userRepository->delete($user);
    }

    public function updateUser(User $user, Request $request)
    {
        $data = $request->toArray();

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

            $existUser = $this->userRepository->findByEmail($userData['email']);

            if ($existUser)
            {
                throw  new Exception('User with that email already exists');
            }

            $user->update(
                [
                'name' => $userData['name'],
                'email' => $userData['email'],
                ]
            );

            return $user;
        }

        catch (\Exception $e)
        {
            return $e->getMessage();
        }
    }
    public function toggleEnableStatusServices(User $user , Request $request): User
    {
        $data = $request->toArray();

        if ($data['is_enabled'])
        {
            $this->userRepository->updateEnable(
                [
                    'enable' => $user->enable = true
                ]
            );
        }

        else
        {
            $this->userRepository->updateEnable(
                [
                    'enable' => $user->enable = false
                ]
            );
        }

        return $user;

    }
    public function getUserWithProducts(Request $request):User
    {
        $user = $request->user();

        $user->load('products');

        return $user;
    }
}
