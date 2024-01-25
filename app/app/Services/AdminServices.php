<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\Exception;
use Illuminate\Support\Facades\Auth;

class AdminServices
{
    public function __construct( protected FiltersServices $userFilterService) {}

    public function getUsersWithRoleAndProducts(Request $request): ?array
    {
        try {
            $user = Auth::user();
            $filter = $request->all();

            if ($user->role_id == 2)
            {
                $usersQuery = $this->userFilterService->applyFilters(User::query(), $filter);
                $users = $this->userFilterService->paginateUser($usersQuery, $filter);

                return
                    [
                    'users' => $users['users'],
                    'total' => $users['total']
                    ];
            }

            return
                [
                'error' => 'impossible to access'
                ];
        }
        catch (\Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }
    }
}
