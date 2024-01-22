<?php

namespace App\Http\Controllers\AdminPanel;

use Illuminate\Http\Request;
use App\Exceptions\Exception;
use App\Services\AdminServices;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function __construct(protected AdminServices $adminService) {}

    /**
     * @throws Exception
     */
    public function getUsersWithRoleAndProducts(Request $request): ?array
    {
        return $this->adminService->getUsersWithRoleAndProducts($request);
    }
}
