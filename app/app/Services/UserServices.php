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
            if (isset($data['name'])) {

                $validatorName = Validator::make($data, ['name' => 'string|max:255',]);

                if ($validatorName->fails()) {

                    throw new InvalidArgumentException($validatorName->errors()->first());
                }
                else {
                    $user->update(['name' => $data['name']]);
                }
            }

            if (isset($data['email'])) {

                $validatorEmail = Validator::make($data, ['email' => 'email',]);

                if ($validatorEmail->fails()) {
                    throw new InvalidArgumentException($validatorEmail->errors()->first());
                }

                $existUser = $this->userRepository->findByEmail($data['email']);

                if ($existUser) {
                    throw new Exception('A user with the same email address already exists');
                }
                else {
                    $user->update(['email' => $data['email'],]);
                }
            }
            return $user;
        }

        catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    public function toggleEnableStatusServices(User $user , Request $request): User
    {
        $data = $request->toArray();

        if ($data['is_enabled']) {
            $this->userRepository->updateEnable(['enable' => $user->enable = true]);
        }

        else {
            $this->userRepository->updateEnable(['enable' => $user->enable = false]);
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
