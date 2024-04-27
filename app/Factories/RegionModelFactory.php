<?php

declare(strict_types=1);

namespace App\Factories;

use App\Domain\Interfaces\RegionInterfaces\RegionBusinessRules;
use App\Domain\Interfaces\RegionInterfaces\RegionEntity;
use App\Domain\Interfaces\RegionInterfaces\RegionFactory;
use App\Models\Region;
use App\UseCases\RegionUseCases\CreateRegionUseCase\CreateRegionRequestModel;
use App\UseCases\RegionUseCases\UpdateRegionUseCase\UpdateRegionRequestModel;

class RegionModelFactory implements RegionFactory
{
    /**
     * @param  CreateRegionRequestModel  $request
     * @return RegionEntity|RegionBusinessRules
     */
    public function makeFromCreateRequest(CreateRegionRequestModel $request): RegionEntity|RegionBusinessRules
    {
        return new Region([
            'name' => $request->getName(),
        ]);
    }

    /**
     * @param  UpdateRegionRequestModel  $request
     * @return RegionEntity|RegionBusinessRules
     */
    public function makeFromPatchRequest(UpdateRegionRequestModel $request): RegionEntity|RegionBusinessRules
    {
        return new Region([
            'id' => $request->getId(),
            'name' => $request->getName(),
        ]);
    }
}
