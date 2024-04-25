<?php

namespace App\Domain\Interfaces\UserInterfaces;

use App\UseCases\UserUseCases\CreateUserUseCase\CreateUserRequestModel;
use App\UseCases\UserUseCases\ResetUserPasswordUseCase\ResetUserPasswordRequestModel;
use App\UseCases\UserUseCases\UpdateUserUseCase\UpdateUserRequestModel;

interface UserFactory
{
    /**
     * @param  CreateUserRequestModel  $request
     * @return UserEntity|UserBusinessRules|UserModel
     */
    public function makeFromCreateRequest(CreateUserRequestModel $request): UserEntity|UserBusinessRules|UserModel;

    /**
     * @param  ResetUserPasswordRequestModel  $request
     * @return UserEntity|UserBusinessRules|UserModel
     */
    public function makeFromResetPasswordRequest(ResetUserPasswordRequestModel $request): UserEntity|UserBusinessRules|UserModel;

    /**
     * @param  UpdateUserRequestModel  $request
     * @return UserEntity|UserBusinessRules|UserModel
     */
    public function makeFromUpdateRequest(UpdateUserRequestModel $request): UserEntity|UserBusinessRules|UserModel;
}
