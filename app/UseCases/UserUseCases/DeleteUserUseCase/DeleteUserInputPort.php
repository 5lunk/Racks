<?php

declare(strict_types=1);

namespace App\UseCases\UserUseCases\DeleteUserUseCase;

use App\Domain\Interfaces\ViewModel;

interface DeleteUserInputPort
{
    /**
     * @param  DeleteUserRequestModel  $request
     * @return ViewModel
     */
    public function deleteUser(DeleteUserRequestModel $request): ViewModel;
}
