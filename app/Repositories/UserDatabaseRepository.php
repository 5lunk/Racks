<?php

namespace App\Repositories;

use App\Domain\Interfaces\UserInterfaces\UserBusinessRules;
use App\Domain\Interfaces\UserInterfaces\UserEntity;
use App\Domain\Interfaces\UserInterfaces\UserModel;
use App\Domain\Interfaces\UserInterfaces\UserRepository;
use App\Models\User;
use Illuminate\Pagination\LengthAwarePaginator;

class UserDatabaseRepository implements UserRepository
{
    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return bool
     *
     * @throws \DomainException|\Illuminate\Contracts\Container\BindingResolutionException
     */
    public function exists(UserEntity|UserBusinessRules|UserModel $user): bool
    {
        return User::where([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ])->exists();
    }

    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return UserEntity|UserBusinessRules|UserModel
     *
     * @throws \DomainException|\Illuminate\Contracts\Container\BindingResolutionException
     */
    public function create(UserEntity|UserBusinessRules|UserModel $user): UserEntity|UserBusinessRules|UserModel
    {
        return User::create([
            'name' => $user->getName(),
            'full_name' => $user->getFullName(),
            'email' => $user->getEmail(),
            'password' => $user->getPassword(),
            'department_id' => $user->getDepartmentId(),
        ]);
    }

    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return UserEntity|UserBusinessRules|UserModel
     *
     * @throws \DomainException|\Illuminate\Contracts\Container\BindingResolutionException
     */
    public function update(UserEntity|UserBusinessRules|UserModel $user): UserEntity|UserBusinessRules|UserModel
    {
        return tap(User::where('id', $user->getId())
            ->first())
            ->update([
                'name' => $user->getName(),
                'full_name' => $user->getFullName(),
                'email' => $user->getEmail(),
                'department_id' => $user->getDepartmentId(),
            ]);
    }

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator
    {
        return User::paginate($perPage);
    }

    /**
     * @param  int  $id
     * @return UserEntity|UserBusinessRules|UserModel
     */
    public function getById(int $id): UserEntity|UserBusinessRules|UserModel
    {
        return User::where('id', $id)
            ->get()
            ->firstOrFail();
    }

    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return UserEntity|UserBusinessRules|UserModel
     *
     * @throws \DomainException|\Illuminate\Contracts\Container\BindingResolutionException
     */
    public function updatePassword(UserEntity|UserBusinessRules|UserModel $user): UserEntity|UserBusinessRules|UserModel
    {
        return tap(User::where('id', $user->getId())
            ->first())
            ->update([
                'password' => $user->getPassword(),
            ]);
    }

    /**
     * @param  UserEntity|UserBusinessRules|UserModel  $user
     * @return int
     */
    public function delete(UserEntity|UserBusinessRules|UserModel $user): int
    {
        return User::where('id', $user->getId())
            ->first()
            ->delete();
    }
}
