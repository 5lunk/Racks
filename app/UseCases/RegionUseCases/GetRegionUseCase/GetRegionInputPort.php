<?php

declare(strict_types=1);

namespace App\UseCases\RegionUseCases\GetRegionUseCase;

use App\Domain\Interfaces\ViewModel;

interface GetRegionInputPort
{
    /**
     * @param  GetRegionRequestModel  $request
     * @return ViewModel
     */
    public function getRegion(GetRegionRequestModel $request): ViewModel;
}
