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

    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray();

        $this->userService->createUser($data);

        return response()->json(['message' => 'User created successfully'], 201);
    }

    public function updateUser(Request $request): UserResource
    {
        $user = Auth::user();

        $data = $request->toArray();

        $updatedUser = $this->userService->updateUser($user, $data);
        if (is_string($updatedUser))
        {
            $error = response()->json(['error' => $updatedUser], 400);
            return new UserResource($error);
        }
        return new UserResource($updatedUser);
    }

    public function deleteUser(): JsonResponse
    {
        $user = Auth::user();

        $this->userService->deleteUser($user);

        return response()->json(['message' => 'User deleted successfully']);
    }

    public function getUser(Request $request): UserResource
    {
        $user = $request->user();

        $userWithProducts = $this->userService->getUserWithProducts($user);

        return new UserResource($userWithProducts);
    }
}
