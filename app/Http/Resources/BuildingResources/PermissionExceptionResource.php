<?php

namespace App\Http\Resources\BuildingResources;

use App\Domain\Interfaces\BuildingInterfaces\BuildingEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PermissionExceptionResource extends JsonResource
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
            'message' => 'Action not allowed for this department',
        ];
    }
}
