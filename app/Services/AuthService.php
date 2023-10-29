<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class AuthService
{
    use ApiResponser;

    /**
     * @param array $data
     * @return JsonResponse
     * @throws \JsonException
     */
    public function login(array $data): JsonResponse
    {
        $token = auth()->attempt([
            'phone' => $data['phone'],
            'password' => $data['password'],
        ]);

        if (!$token) {
            Log::info($data['phone'] . '.login Phone or password is not correct');
            return $this->errorResponse(__('user_service_phone_or_password_is_not_correct'), Response::HTTP_UNAUTHORIZED);
        }

        $user = User::query()
            ->where('id', auth()->id())
            ->first();

        return $this->successResponse([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => $user,
        ]);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $user = auth()->user();

        auth()->logout();

        return $this->successResponse([
            'message' => __('user successfully logged out'),
        ]);
    }
}
