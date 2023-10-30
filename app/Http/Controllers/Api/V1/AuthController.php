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

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     summary="Get jwt token",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     property="phone",
     *                     type="string",
     *                     example="+380951234567"
     *                 ),
     *                 @OA\Property(
     *                     property="password",
     *                     type="string"
     *                 ),
     *                 example={"phone": "+380951234567", "password": "88888888"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             example={
     *                 "data": {
     *                     "access_token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
     *                     "token_type": "bearer",
     *                     "expires_in": 360000,
     *                     "user": {
     *                         "id": 1,
     *                         "name": "Alexis Gleason",
     *                         "email": "fisher.nellie@example.com",
     *                         "phone": "+380954474265",
     *                         "city": "Florida",
     *                         "email_verified_at": "2023-10-29T08:33:28.000000Z",
     *                         "created_at": "2023-10-29T08:33:29.000000Z",
     *                         "updated_at": "2023-10-29T08:33:29.000000Z"
     *                     }
     *                 },
     *                 "code": 200
     *             }
     *         )
     *     )
     * )
     */
    public function login(UserAuthRequest $request): JsonResponse
    {
        $data = $request->validated();

        return $this->authService->login($data);
    }

    /**
     * @OA\Get (
     *     path="/api/v1/user/logout",
     *     operationId="logout",
     *     tags={"Auth"},
     *     summary="Logout user",
     *     security={{"bearer_token":{}}},
     *     @OA\Response(response=200, description="OK")
     * )
     */
    public function logout(): JsonResponse
    {
        return  $this->authService->logout();
    }

}
