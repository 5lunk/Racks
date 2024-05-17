<?php

declare(strict_types=1);

namespace App\Factories;

use App\Domain\Interfaces\UserInterfaces\UserBusinessRules;
use App\Domain\Interfaces\UserInterfaces\UserEntity;
use App\Domain\Interfaces\UserInterfaces\UserFactory;
use App\Models\User;
use App\Models\ValueObjects\EmailValueObject;
use App\Models\ValueObjects\PasswordValueObject;
use App\UseCases\UserUseCases\CreateUserUseCase\CreateUserRequestModel;
use App\UseCases\UserUseCases\ResetUserPasswordUseCase\ResetUserPasswordRequestModel;
use App\UseCases\UserUseCases\UpdateUserUseCase\UpdateUserRequestModel;

class UserModelFactory implements UserFactory
{
    /**
     * @param  CreateUserRequestModel  $request
     * @return UserEntity&UserBusinessRules
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeFromCreateRequest(CreateUserRequestModel $request): UserEntity&UserBusinessRules
    {
        return new User([
            'name' => $request->getName(),
            'full_name' => $request->getFullName(),
            'email' => App()->makeWith(EmailValueObject::class, ['email' => $request->getEmail()]),
            'password' => App()->makeWith(PasswordValueObject::class, ['password' => $request->getPassword()]),
            'department_id' => $request->getDepartmentId(),
        ]);
    }

    /**
     * @param  ResetUserPasswordRequestModel  $request
     * @return UserEntity&UserBusinessRules
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeFromResetPasswordRequest(ResetUserPasswordRequestModel $request): UserEntity&UserBusinessRules
    {
        return new User([
            'id' => $request->getId(),
            'password' => App()->makeWith(PasswordValueObject::class, ['password' => $request->getPassword()]),
        ]);
    }

    /**
     * @param  UpdateUserRequestModel  $request
     * @return UserEntity&UserBusinessRules
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function makeFromUpdateRequest(UpdateUserRequestModel $request): UserEntity&UserBusinessRules
    {
        return new User([
            'id' => $request->getId(),
            'name' => $request->getName(),
            'full_name' => $request->getFullName(),
            'email' => App()->makeWith(EmailValueObject::class, ['email' => $request->getEmail()]),
            'department_id' => $request->getDepartmentId(),
        ]);
    }
}
