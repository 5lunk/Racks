<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\UserInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepository
{
    /**
     * @param  UserEntity|UserBusinessRules  $user
     * @return bool
     */
    public function exists(UserEntity|UserBusinessRules $user): bool;

    /**
     * @param  UserEntity|UserBusinessRules  $user
     * @return UserEntity|UserBusinessRules
     */
    public function create(UserEntity|UserBusinessRules $user): UserEntity|UserBusinessRules;

    /**
     * @param  int|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?int $perPage): LengthAwarePaginator;

    /**
     * @param  int  $id
     * @return UserEntity|UserBusinessRules
     */
    public function getById(int $id): UserEntity|UserBusinessRules;

    /**
     * @param  UserEntity|UserBusinessRules  $user
     * @return UserEntity|UserBusinessRules
     */
    public function updatePassword(UserEntity|UserBusinessRules $user): UserEntity|UserBusinessRules;

    /**
     * @param  UserEntity|UserBusinessRules  $user
     * @return UserEntity|UserBusinessRules
     */
    public function update(UserEntity|UserBusinessRules $user): UserEntity|UserBusinessRules;

    /**
     * @param  UserEntity|UserBusinessRules  $user
     * @return bool
     */
    public function delete(UserEntity|UserBusinessRules $user): bool;
}
