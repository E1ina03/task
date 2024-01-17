<?php

namespace App\Http\Controllers\AdminPanel;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AdminServices;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct(protected AdminServices $adminService) {}

    public function getUsersWithRoleAndProducts(): User
    {
        $user = Auth::user();
        $usersData = $this->adminService->getUsersWithRoleAndProducts($user);

        return $usersData;
    }
}

