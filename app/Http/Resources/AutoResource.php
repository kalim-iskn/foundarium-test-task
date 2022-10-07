<?php

namespace App\Http\Resources;

use App\DTO\AutoDto;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="Auto",
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
 * )
 */
class AutoResource extends JsonResource
{
    public function toArray($request)
    {
        /** @var AutoDto $auto */
        $auto = $this->resource;

        return [
            "id" => $auto->id,
            "name" => $auto->name
        ];
    }
}
