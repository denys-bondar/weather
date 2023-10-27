<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserAuthRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{

    public function __construct(private readonly AuthService $authService)
    {
    }

    public function login(UserAuthRequest $request): JsonResponse
    {
        $data = $request->validated();

        return $this->authService->login($data);
    }

    public function logout(): JsonResponse
    {
        return  $this->authService->logout();
    }

}
