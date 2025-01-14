<?php

declare(strict_types=1);

namespace App\UseCases\BuildingUseCases\CreateBuildingUseCase;

use App\Domain\Interfaces\ViewModel;

interface CreateBuildingInputPort
{
    /**
     * @param  CreateBuildingRequestModel  $request
     * @return ViewModel
     */
    public function createBuilding(CreateBuildingRequestModel $request): ViewModel;
}
