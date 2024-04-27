<?php

declare(strict_types=1);

namespace App\UseCases\RackUseCases\UpdateRackUseCase;

use App\Domain\Interfaces\ViewModel;

interface UpdateRackInputPort
{
    /**
     * @param  UpdateRackRequestModel  $request
     * @return ViewModel
     */
    public function updateRack(UpdateRackRequestModel $request): ViewModel;
}
