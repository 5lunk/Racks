<?php

declare(strict_types=1);

namespace App\UseCases\RackUseCases\GetRackUseCase;

use App\Domain\Interfaces\ViewModel;

interface GetRackInputPort
{
    /**
     * @param  GetRackRequestModel  $request
     * @return ViewModel
     */
    public function getRack(GetRackRequestModel $request): ViewModel;
}
