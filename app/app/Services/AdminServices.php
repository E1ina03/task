<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\Exception;
use App\Models\EnumForEnable;
use Illuminate\Support\Facades\Auth;

class AdminServices
{

    /**
     * @throws Exception
     */
    public function getUsersWithRoleAndProducts(Request $request): ?array
    {
        $user = Auth::user();
        $filter = $request->get('enable');
        $sorting = $request->get('name');
        try {
            $filteredUsers = [];

            if ($user->role_id == 2) {
                if ($sorting == 'asc'|| $sorting == 'desc'){
                    $users = User::query()->orderBy('name', $sorting)->get();
            }
                else{
                    $users = User::query()->get();
                }

                if ($filter == null) {
                    $usersData = $users->map(function (User $user) {
                        return [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'role' => $user->role->name,
                            'product' => $user->products,
                        ];
                    })->toArray();

                    return ['users' => $usersData];
                }
                foreach ($users as $currentUser) {
                    if (($filter == EnumForEnable::ENABLED->value || $filter == EnumForEnable::DISABLED->value)
                        && $currentUser->enable == $filter) {
                        $filteredUsers[] =
                            [
                                'id' => $currentUser->id,
                                'name' => $currentUser->name,
                                'email' => $currentUser->email,
                                'role' => $currentUser->role->name,
                                'product' => $currentUser->products,
                            ];
                    }
                }
            }return ['users' => $filteredUsers];
        }
        catch (\Exception)
        {
            throw new Exception('user not found');
        }
    }
}
