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

    /**
     * @OA\Patch(
     *     path="/api/v1/user/update",
     *     summary="Update user info",
     *     tags={"User"},
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
     *                      property="email",
     *                      type="string",
     *                      example="asd@asd.gg"
     *                  ),
     *                @OA\Property(
     *                       property="city",
     *                       type="string",
     *                       example="Lviv"
     *                   ),
     *                @OA\Property(
     *                        property="name",
     *                        type="string",
     *                        example="Petro"
     *                ),
     *                 example={"phone": "+380951234567", "name": "Petro", "email": "asd@asd.gg", "city": "Lviv"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             example={
     *                 "data": {
     *                     "message": "succes",
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
    public function updateUser(UserUpdateRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->userService->update($data);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/user/update",
     *     summary="Register new user",
     *     tags={"User"},
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
     *                      property="email",
     *                      type="string",
     *                      example="asd@asd.gg"
     *                  ),
     *                @OA\Property(
     *                       property="city",
     *                       type="string",
     *                       example="Lviv"
     *                   ),
     *                @OA\Property(
     *                        property="name",
     *                        type="string",
     *                        example="Petro"
     *                ),
     *                 example={"phone": "+380951234567", "name": "Petro", "email": "asd@asd.gg", "city": "Lviv"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="OK",
     *         @OA\JsonContent(
     *             example={
     *                 "data": {
     *                     "message": "succes",
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
    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();
        return $this->userService->register($data);
    }
}
