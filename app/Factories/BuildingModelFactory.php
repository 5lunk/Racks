<?php

namespace App\Factories;

use App\Domain\Interfaces\BuildingInterfaces\BuildingBusinessRules;
use App\Domain\Interfaces\BuildingInterfaces\BuildingEntity;
use App\Domain\Interfaces\BuildingInterfaces\BuildingFactory;
use App\Domain\Interfaces\BuildingInterfaces\BuildingModel;
use App\Models\Building;
use App\UseCases\BuildingUseCases\CreateBuildingUseCase\CreateBuildingRequestModel;
use App\UseCases\BuildingUseCases\UpdateBuildingUseCase\UpdateBuildingRequestModel;

class BuildingModelFactory implements BuildingFactory
{
    /**
     * @param  CreateBuildingRequestModel  $request
     * @return BuildingEntity|BuildingBusinessRules|BuildingModel
     */
    public function makeFromCreateRequest(CreateBuildingRequestModel $request): BuildingEntity|BuildingBusinessRules|BuildingModel
    {
        return new Building([
            'name' => $request->getName(),
            'description' => $request->getDescription(),
            'site_id' => $request->getSiteId(),
        ]);
    }

    /**
     * @param  UpdateBuildingRequestModel  $request
     * @return BuildingEntity|BuildingBusinessRules|BuildingModel
     */
    public function makeFromPatchRequest(UpdateBuildingRequestModel $request): BuildingEntity|BuildingBusinessRules|BuildingModel
    {
        return new Building([
            'id' => $request->getId(),
            'description' => $request->getDescription(),
            'name' => $request->getName(),
            'site_id' => $request->getSiteId(),
            'department_id' => $request->getDepartmentId(),
        ]);
    }
}
