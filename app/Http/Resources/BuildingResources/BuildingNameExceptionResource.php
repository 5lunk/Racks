<?php

declare(strict_types=1);

namespace App\Http\Resources\BuildingResources;

use App\Domain\Interfaces\BuildingInterfaces\BuildingEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="BuildingNameExceptionResponse",
 *     title="Building with this name already exists in this site",
 *
 *         @OA\Property(
 *              property="message",
 *              type="string",
 *              example="Building with this name already exists in this site"
 *         )
 *     )
 * )
 */
class BuildingNameExceptionResource extends JsonResource
{
    /**
     * @var BuildingEntity
     */
    protected BuildingEntity $building;

    /**
     * @param  BuildingEntity  $building
     */
    public function __construct(BuildingEntity $building)
    {
        parent::__construct($building);
        $this->building = $building;
    }

    /**
     * @param  Request  $request
     * @return array<mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'Building with this name already exists in this site',
        ];
    }
}
