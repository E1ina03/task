<?php

namespace App\Services;

use App\Exceptions\Exception;
use App\Models\User;

class AdminServices
{
    public function getUsersWithRoleAndProducts($user): User
    {
        try {
            if ($user->role_id == 2){
                $users = User::query()->get();
                $usersData = $users->map(function ($user) {
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'email' => $user->email,
                        'role' => $user->role->name,
                        'product' => $user->products,
                    ];
                });
            }

            return $usersData;
        }
        catch (\Exception ) {
            throw new Exception('user not found');
        }
    }
}
