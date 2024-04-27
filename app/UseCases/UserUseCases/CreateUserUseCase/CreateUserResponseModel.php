<?php

declare(strict_types=1);

namespace App\UseCases\UserUseCases\CreateUserUseCase;

use App\Domain\Interfaces\UserInterfaces\UserEntity;

class CreateUserResponseModel
{
    /**
     * @param  UserEntity  $user
     */
    public function __construct(
        private readonly UserEntity $user
    ) {
    }

    /**
     * @return UserEntity
     */
    public function getUser(): UserEntity
    {
        return $this->user;
    }
}
