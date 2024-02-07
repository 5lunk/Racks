<?php

namespace App\Http\Resources\BuildingResources;

use App\Domain\Interfaces\BuildingInterfaces\BuildingEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="NoSuchBuildingForBuildingResponse",
 *     title="No such building",
 *
 *         @OA\Property(
 *              property="message",
 *              type="string",
 *              example="No such building"
 *         )
 *     )
 * )
 */
class NoSuchBuildingResource extends JsonResource
{
    protected ?BuildingEntity $building;

    public function __construct(?BuildingEntity $building)
    {
        parent::__construct($building);
        $this->building = $building;
    }

    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'No such building',
        ];
    }
}
