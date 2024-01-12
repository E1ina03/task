<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Services\UserServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct(protected UserServices $userService)
    {
    }

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
    public function updateUser(Request $request):UserResource
    {
        $user = Auth::user();

        $updateUser = $this->userService->updateUser($user, $request);

        return new UserResource($updateUser);
    }
    public function deleteUser(): JsonResponse
    {
        $user = Auth::user();

        $this->userService->deleteUser($user);

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function getUser(Request $request): UserResource
    {
        $userWithProducts = $this->userService->getUserWithProducts($request);

        return new UserResource($userWithProducts);
    }
}
