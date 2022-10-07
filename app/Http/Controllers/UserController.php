<?php

namespace App\Http\Controllers;

use App\DTO\Requests\SetAutoRequest;
use App\Http\Resources\OkResponse;
use App\Http\Resources\UserResource;
use App\Services\UserService;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @OA\Get(
     *     path="/api/user",
     *     tags={"User"},
     *     description="List of users",
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/User")
     *             ),
     *         )
     *     )
     * )
     */
    public function getList(): AnonymousResourceCollection
    {
        return UserResource::collection($this->userService->getAll());
    }

    /**
     * @OA\Put(
     *     path="/api/user/{userId}/auto/{autoId}",
     *     tags={"User"},
     *     description="Set auto to user",
     *     @OA\Parameter(
     *         in="path",
     *         name="userId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="autoId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/User")
     *             ),
     *         )
     *     )
     * )
     */
    public function setAuto(int $userId, int $autoId): UserResource
    {
        return new UserResource($this->userService->setAuto(new SetAutoRequest($userId, $autoId)));
    }

    /**
     * @OA\Delete(
     *     path="/api/user/auto/{autoId}",
     *     tags={"User"},
     *     description="Free auto",
     *     @OA\Parameter(
     *         in="path",
     *         name="autoId",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="Ok",
     *         @OA\JsonContent(
     *             @OA\Property(
     *                 property="data",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/OkResponse")
     *             ),
     *         )
     *     )
     * )
     */
    public function freeAuto(int $autoId): OkResponse
    {
        $this->userService->freeAuto($autoId);
        return new OkResponse();
    }
}
