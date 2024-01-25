<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\Request;
use App\Exceptions\Exception;
use Illuminate\Support\Facades\Auth;

class AdminServices
{
    /**
     * @throws Exception
     */
    public function getUsersWithRoleAndProducts(Request $request): ?array
    {
        $user = Auth::user();

        $filter = $request->all();

        $perPage = $filter['limit'];

        $page = $filter['offset'];

        try {
            $filteredUsers = [];

            if ($user->role_id == 2)
            {
                $users = User::query()->paginate($perPage, page: $page);

                if (isset($filter['name']))
                {
                    $users = User::query()->orderBy('name', $filter['name'])
                        ->paginate($perPage, page: $page);
                }
                if (isset($filter['firstname']))
                {
                    if (isset($filter['name']))
                    {
                        $users = User::query()->where('name',$filter['firstname'])
                            ->orderBy('name', $filter['name'])
                            ->paginate($perPage, page: $page);
                    }
                   else
                   {
                       $users = User::query()->where('name',$filter['firstname'])
                           ->paginate($perPage, page: $page);
                   }
                }

                if (isset($filter['enable']) === false)
                {
                    $usersTotal = $users->total();
                    return [
                        'users' => $users,
                        'total' => $usersTotal
                    ];
                }

                if (isset($filter['enable']))
                {
                    if (isset($filter['name']))
                    {
                        $filteredUsers = User::query()->where('enable', $filter['enable'])
                            ->orderBy('name', $filter['name'])
                            ->paginate($perPage, page: $page);
                    }
                    elseif (isset($filter['firstname']))
                    {
                        $filteredUsers = User::query()->where('enable', $filter['enable'])
                            ->where('name', $filter['firstname'])
                            ->paginate($perPage, page: $page);
                    }
                    elseif (isset($filter['name']) && isset($filter['firstname']))
                    {
                        $filteredUsers = User::query()->where('enable', $filter['enable'])
                            ->where('name', $filter['firstname'])
                            ->orderBy('name', $filter['name'])
                            ->paginate($perPage, page: $page);
                    }
                    else
                    {
                        $filteredUsers = User::query()->where('enable', $filter['enable'])
                            ->paginate(
                            $perPage,
                            page: $page
                        );
                    }
                }
            }
            $filteredUsersTotal = $filteredUsers->total();
            return ['users' => $filteredUsers, 'total' => $filteredUsersTotal];
        }
        catch (\Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }
    }
}
