<?php

namespace App\Factories;

use App\Domain\Interfaces\RegionInterfaces\RegionBusinessRules;
use App\Domain\Interfaces\RegionInterfaces\RegionEntity;
use App\Domain\Interfaces\RegionInterfaces\RegionFactory;
use App\Domain\Interfaces\RegionInterfaces\RegionModel;
use App\Models\Region;
use App\UseCases\RegionUseCases\CreateRegionUseCase\CreateRegionRequestModel;
use App\UseCases\RegionUseCases\UpdateRegionUseCase\UpdateRegionRequestModel;

class RegionModelFactory implements RegionFactory
{
    /**
     * @param  CreateRegionRequestModel  $request
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function makeFromCreateRequest(CreateRegionRequestModel $request): RegionEntity|RegionModel|RegionBusinessRules
    {
        return new Region([
            'name' => $request->getName(),
        ]);
    }

    /**
     * @param  UpdateRegionRequestModel  $request
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function makeFromPatchRequest(UpdateRegionRequestModel $request): RegionEntity|RegionModel|RegionBusinessRules
    {
        return new Region([
            'id' => $request->getId(),
            'name' => $request->getName(),
        ]);
    }
}
