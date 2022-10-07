<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     schema="OkResponse",
 *     @OA\Property(
 *          property="status",
 *          type="string",
 *          readOnly="true"
 *     )
 * )
 */
class OkResponse extends JsonResource
{
    public function __construct()
    {
        parent::__construct(null);
    }

    public function toArray($request)
    {
        return [
            "status" => "ok"
        ];
    }
}
