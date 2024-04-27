<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\UserInterfaces;

use App\UseCases\UserUseCases\CreateUserUseCase\CreateUserRequestModel;
use App\UseCases\UserUseCases\ResetUserPasswordUseCase\ResetUserPasswordRequestModel;
use App\UseCases\UserUseCases\UpdateUserUseCase\UpdateUserRequestModel;

interface UserFactory
{
    /**
     * @param  CreateUserRequestModel  $request
     * @return UserEntity|UserBusinessRules
     */
    public function makeFromCreateRequest(CreateUserRequestModel $request): UserEntity|UserBusinessRules;

    /**
     * @param  ResetUserPasswordRequestModel  $request
     * @return UserEntity|UserBusinessRules
     */
    public function makeFromResetPasswordRequest(ResetUserPasswordRequestModel $request): UserEntity|UserBusinessRules;

    /**
     * @param  UpdateUserRequestModel  $request
     * @return UserEntity|UserBusinessRules
     */
    public function makeFromUpdateRequest(UpdateUserRequestModel $request): UserEntity|UserBusinessRules;
}
