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

        try
        {
            $filteredUsers = [];

            if ($user->role_id == 2)
            {
                $users = User::query()->get();

                if (isset($filter['name']))
                {
                    $users = User::query()->orderBy('name', $filter['name'])->get();
                }
                if (isset($filter['enable']) === false)
                {
                    return ['users' => $users];
                }
                if (isset($filter['enable']))
                {
                    if (isset($filter['name']))
                    {
                      $filteredUsers = User::query()->where('enable', $filter['enable'])
                          ->orderBy('name',$filter['name'])->get();
                  }
                    else{
                        $filteredUsers = User::query()->where('enable', $filter['enable'])->get();
                    }
                }
            }
            return ['users' => $filteredUsers];
        }
        catch (\Exception $exception)
        {
            throw new Exception($exception->getMessage());
        }
    }
}
