<?php

declare(strict_types=1);

namespace App\UseCases\UserUseCases\CreateUserUseCase;

use App\Domain\Interfaces\ViewModel;

interface CreateUserInputPort
{
    /**
     * @param  CreateUserRequestModel  $request
     * @return ViewModel
     */
    public function createUser(CreateUserRequestModel $request): ViewModel;
}
