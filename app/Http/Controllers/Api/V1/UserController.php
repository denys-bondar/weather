<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserRegisterRequest;
use App\Http\Requests\Api\V1\User\UserUpdateRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;


class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    /**
     * @OA\Get (
     *     path="/api/v1/user",
     *     operationId="Get user info",
     *     tags={"User"},
     *     summary="get authorized user",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(response=200, description="OK")
     * )
     */
    public function me(): JsonResponse
    {
        return $this->userService->me();
    }

    public function updateUser(UserUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->userService->update($data);
    }

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->userService->register($data);
    }
}
