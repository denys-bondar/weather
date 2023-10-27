<?php

namespace App\Services;

use App\Models\User;
use App\Traits\ApiResponser;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class UserService
{
    use ApiResponser;

    public function me(): JsonResponse
    {
        return $this->successResponse($this->getCurrentUser());
    }

    public function update(array $data): JsonResponse
    {
        $user = $this->getCurrentUser();
        $user->fill($data);

        if (!$user->isDirty()) {
            return $this->successResponse(['message' => __('success'), 'user' => $user]);
        }

        $user->save();

        return $this->successResponse(['message' => __('success'), 'user' => $user]);
    }


    public function register(array $data): JsonResponse
    {
        // Хеширование пароля
        $data['password'] = Hash::make($data['password']);

        // Создание нового пользователя
        $user = User::create($data);

        return $this->successResponse(['message' => __('success'), 'user' => $user]);
    }

    protected function getCurrentUser(): User
    {
        return User::find(auth()->id());
    }
}
