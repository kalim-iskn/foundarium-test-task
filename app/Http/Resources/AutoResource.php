<?php

namespace App\Http\Resources;

use App\Models\Auto;
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
        /** @var Auto $auto */
        $auto = $this->resource;

        return [
            "id" => $auto->id,
            "name" => $auto->name
        ];
    }
}
