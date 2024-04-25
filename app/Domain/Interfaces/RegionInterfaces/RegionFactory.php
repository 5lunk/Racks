<?php

namespace App\Domain\Interfaces\RegionInterfaces;

use App\UseCases\RegionUseCases\CreateRegionUseCase\CreateRegionRequestModel;
use App\UseCases\RegionUseCases\UpdateRegionUseCase\UpdateRegionRequestModel;

interface RegionFactory
{
    /**
     * @param  CreateRegionRequestModel  $request
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function makeFromCreateRequest(CreateRegionRequestModel $request): RegionEntity|RegionModel|RegionBusinessRules;

    /**
     * @param  UpdateRegionRequestModel  $request
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function makeFromPatchRequest(UpdateRegionRequestModel $request): RegionEntity|RegionModel|RegionBusinessRules;
}
