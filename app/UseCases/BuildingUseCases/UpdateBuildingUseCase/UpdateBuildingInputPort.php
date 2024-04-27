<?php

declare(strict_types=1);

namespace App\UseCases\BuildingUseCases\UpdateBuildingUseCase;

use App\Domain\Interfaces\ViewModel;

interface UpdateBuildingInputPort
{
    /**
     * @param  UpdateBuildingRequestModel  $request
     * @return ViewModel
     */
    public function updateBuilding(UpdateBuildingRequestModel $request): ViewModel;
}
