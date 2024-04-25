<?php

namespace App\Domain\Interfaces\BuildingInterfaces;

use App\UseCases\BuildingUseCases\CreateBuildingUseCase\CreateBuildingRequestModel;
use App\UseCases\BuildingUseCases\UpdateBuildingUseCase\UpdateBuildingRequestModel;

interface BuildingFactory
{
    /**
     * @param  CreateBuildingRequestModel  $request
     * @return BuildingEntity|BuildingBusinessRules|BuildingModel
     */
    public function makeFromCreateRequest(CreateBuildingRequestModel $request): BuildingEntity|BuildingBusinessRules|BuildingModel;

    /**
     * @param  UpdateBuildingRequestModel  $request
     * @return BuildingEntity|BuildingBusinessRules|BuildingModel
     */
    public function makeFromPatchRequest(UpdateBuildingRequestModel $request): BuildingEntity|BuildingBusinessRules|BuildingModel;
}
