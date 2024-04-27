<?php

declare(strict_types=1);

namespace App\UseCases\UserUseCases\UpdateUserUseCase;

use App\Domain\Interfaces\ViewModel;

interface UpdateUserInputPort
{
    /**
     * @param  UpdateUserRequestModel  $request
     * @return ViewModel
     */
    public function updateUser(UpdateUserRequestModel $request): ViewModel;
}
