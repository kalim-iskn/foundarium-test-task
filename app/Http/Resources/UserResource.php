<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="User",
 *     @OA\Property(
 *          property="id",
 *          type="integer",
 *          readOnly="true"
 *     ),
 *     @OA\Property(
 *          property="name",
 *          type="string",
 *          readOnly="true"
 *     ),
 *     @OA\Property(
 *          property="auto",
 *          type="array",
 *          nullable="true",
 *          @OA\Items(ref="#/components/schemas/Auto")
 *     ),
 * )
 */
class UserResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var User $user */
        $user = $this->resource;

        return [
            "id" => $user->id,
            "name" => $user->name,
            "auto" => $user->auto ? new AutoResource($user->auto) : null
        ];
    }
}
