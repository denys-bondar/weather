<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserLoginRequest;
use App\Services\User\UserService;
use Illuminate\Http\JsonResponse;


class AuthController extends Controller
{

    public function __construct(private readonly UserService $userService)
    {
    }

    public function login(UserLoginRequest $request): JsonResponse
    {
        $data = $request->validated();

        return  $this->userService->login($data);
    }

}
