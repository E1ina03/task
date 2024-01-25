<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserServices $userService) {}

    public function create(Request $request): UserResource
    {
        $user =  $this->userService->createUser($request);

        return new UserResource($user);
    }

    public function toggleEnableStatus(Request $request): UserResource
    {
        $user = Auth::user();

        $updatedUser = $this->userService->toggleEnableStatusServices($user,$request);

        return new UserResource($updatedUser);
    }
    public function updateUser(Request $request)
    {
        $updateUser = $this->userService->updateUser($request);

        return  $updateUser;
    }
    public function deleteUser(): JsonResponse
    {
        $this->userService->deleteUser();

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function getUsers(Request $request): UserResource
    {
        $userWithProducts = $this->userService->getUsersWithProducts($request);

        return new UserResource($userWithProducts);
    }
}
