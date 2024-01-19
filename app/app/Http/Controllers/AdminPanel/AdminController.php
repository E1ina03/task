<?php

namespace App\Http\Controllers\AdminPanel;

use App\Exceptions\Exception;
use App\Http\Controllers\Controller;
use App\Services\AdminServices;
use Illuminate\Http\Request;
class AdminController extends Controller
{
    public function __construct(protected AdminServices $adminService) {}

    /**
     * @throws Exception
     */
    public function getUsersWithRoleAndProducts(Request $request): array
    {
        return $this->adminService->getUsersWithRoleAndProducts($request);
    }
}

