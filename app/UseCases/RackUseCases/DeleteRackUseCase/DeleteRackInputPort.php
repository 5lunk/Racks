<?php

declare(strict_types=1);

namespace App\UseCases\RackUseCases\DeleteRackUseCase;

use App\Domain\Interfaces\ViewModel;

interface DeleteRackInputPort
{
    /**
     * @param  DeleteRackRequestModel  $request
     * @return ViewModel
     */
    public function deleteRack(DeleteRackRequestModel $request): ViewModel;
}
