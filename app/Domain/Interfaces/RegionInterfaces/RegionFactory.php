<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\RegionInterfaces;

use App\UseCases\RegionUseCases\CreateRegionUseCase\CreateRegionRequestModel;
use App\UseCases\RegionUseCases\UpdateRegionUseCase\UpdateRegionRequestModel;

interface RegionFactory
{
    /**
     * @param  CreateRegionRequestModel  $request
     * @return RegionEntity&RegionBusinessRules
     */
    public function makeFromCreateRequest(CreateRegionRequestModel $request): RegionEntity&RegionBusinessRules;

    /**
     * @param  UpdateRegionRequestModel  $request
     * @return RegionEntity&RegionBusinessRules
     */
    public function makeFromPatchRequest(UpdateRegionRequestModel $request): RegionEntity&RegionBusinessRules;
}
