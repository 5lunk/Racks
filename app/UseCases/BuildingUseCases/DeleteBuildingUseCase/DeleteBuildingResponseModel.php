<?php

declare(strict_types=1);

namespace App\UseCases\BuildingUseCases\DeleteBuildingUseCase;

use App\Domain\Interfaces\BuildingInterfaces\BuildingEntity;

class DeleteBuildingResponseModel
{
    /**
     * @param  BuildingEntity|null  $building  Null for no such building response
     */
    public function __construct(
        private readonly ?BuildingEntity $building
    ) {
    }

    /**
     * @return BuildingEntity|null
     */
    public function getBuilding(): ?BuildingEntity
    {
        return $this->building;
    }
}
