<?php

declare(strict_types=1);

namespace App\UseCases\RegionUseCases\DeleteRegionUseCase;

use App\Domain\Interfaces\ViewModel;

interface DeleteRegionInputPort
{
    /**
     * @param  DeleteRegionRequestModel  $request
     * @return ViewModel
     */
    public function deleteRegion(DeleteRegionRequestModel $request): ViewModel;
}
