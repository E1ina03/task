<?php

namespace App\Services;

use App\Exceptions\Exception;
use App\Models\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use InvalidArgumentException;

class UserServices
{
    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function createUser(Request $request): User
    {
        $data = $request->toArray();

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role_name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            throw new InvalidArgumentException($validator->errors()->first());
        }

        $role = Role::where('name', $data['role_name'])->first();

        if (!$role) {
            throw new InvalidArgumentException('Role not found for name: ' . $data['role_name']);
        }

        $userData = [
            "name" => $data['name'],
            "email" => $data['email'],
            "password" => bcrypt($data['password']),
            "role_id" => $role->id
        ];

        $user = $this->userRepository->create($userData);
        $user->setAttribute('role_name', $role->name);

        return $user;
    }

    public function deleteUser(): void
    {
        $id = Auth::id();
        $this->userRepository->delete($id);
    }

    public function updateUser(Request $request)
    {
        $user = Auth::user();
        $data = $request->toArray();

        try {
            if (isset($data['name']) || isset($data['email']) || (isset($data['name'])) && isset($data['email'])) {
                $validatorName = Validator::make($data,
                    [
                    'name' => 'string|max:255',
                    'email' => 'string'
                ]);

                if ($validatorName->fails())
                {
                    throw new InvalidArgumentException($validatorName->errors()->first());
                }
                else {
                    $user->update([
                        'name' => $data['name']
                    ]);

                    $check = User::query()->where('email', $data['email'])->first();

                    if ($check)
                    {
                        throw new InvalidArgumentException('Email already exists');
                    }
                    else {
                       $user->update([
                            'email' => $data['email']
                        ]);
                    }
                }
            }
            return $user;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function toggleEnableStatusServices(User $user, Request $request): User
    {
        $data = $request->toArray();

        if ($data['is_enabled']) {
            $this->userRepository->updateEnable(['enable' => $user->enable = true]);
        } else {
            $this->userRepository->updateEnable(['enable' => $user->enable = false]);
        }

        return $user;
    }

    public function getUsersWithProducts(Request $request): User
    {
        $user = $request->user();

        $user->load('products');

        return $user;
    }
}
