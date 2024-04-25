<?php

namespace App\Domain\Interfaces\UserInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepository
{
    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return bool
     */
    public function exists(UserEntity|UserBusinessRules|UserModel $user): bool;

    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return UserEntity|UserBusinessRules|UserModel
     */
    public function create(UserEntity|UserBusinessRules|UserModel $user): UserEntity|UserBusinessRules|UserModel;

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator;

    /**
     * @param  int  $id
     * @return UserEntity|UserBusinessRules|UserModel
     */
    public function getById(int $id): UserEntity|UserBusinessRules|UserModel;

    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return UserEntity|UserBusinessRules|UserModel
     */
    public function updatePassword(UserEntity|UserBusinessRules|UserModel $user): UserEntity|UserBusinessRules|UserModel;

    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return UserEntity|UserBusinessRules|UserModel
     */
    public function update(UserEntity|UserBusinessRules|UserModel $user): UserEntity|UserBusinessRules|UserModel;

    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return int
     */
    public function delete(UserEntity|UserBusinessRules|UserModel $user): int;
}
