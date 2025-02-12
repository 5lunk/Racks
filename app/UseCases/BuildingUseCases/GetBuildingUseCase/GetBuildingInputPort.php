<?php

declare(strict_types=1);

namespace App\UseCases\BuildingUseCases\GetBuildingUseCase;

use App\Domain\Interfaces\ViewModel;

interface GetBuildingInputPort
{
    /**
     * @param  GetBuildingRequestModel  $request
     * @return ViewModel
     */
    public function getBuilding(GetBuildingRequestModel $request): ViewModel;
}
