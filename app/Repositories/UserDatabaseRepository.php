<?php

namespace App\Repositories;

use App\Domain\Interfaces\UserInterfaces\UserBusinessRules;
use App\Domain\Interfaces\UserInterfaces\UserEntity;
use App\Domain\Interfaces\UserInterfaces\UserRepository;
use App\Models\User;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;

class UserDatabaseRepository implements UserRepository
{
    /**
     * @param  UserEntity|UserBusinessRules  $user
     * @return bool
     *
     * @throws BindingResolutionException
     */
    public function exists(UserEntity|UserBusinessRules $user): bool
    {
        return User::where([
            'name' => $user->getName(),
            'email' => $user->getEmail(),
        ])->exists();
    }

    /**
     * @param  UserEntity|UserBusinessRules  $user
     * @return UserEntity|UserBusinessRules
     *
     * @throws BindingResolutionException
     */
    public function create(UserEntity|UserBusinessRules $user): UserEntity|UserBusinessRules
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
     * @param  UserEntity|UserBusinessRules  $user
     * @return UserEntity|UserBusinessRules
     *
     * @throws BindingResolutionException
     */
    public function update(UserEntity|UserBusinessRules $user): UserEntity|UserBusinessRules
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
     * @return UserEntity|UserBusinessRules
     */
    public function getById(int $id): UserEntity|UserBusinessRules
    {
        return User::where('id', $id)
            ->get()
            ->firstOrFail();
    }

    /**
     * @param  UserEntity|UserBusinessRules  $user
     * @return UserEntity|UserBusinessRules
     *
     * @throws BindingResolutionException
     */
    public function updatePassword(UserEntity|UserBusinessRules $user): UserEntity|UserBusinessRules
    {
        return tap(User::where('id', $user->getId())
            ->first())
            ->update([
                'password' => $user->getPassword(),
            ]);
    }

    /**
     * @param  UserEntity|UserBusinessRules  $user
     * @return int
     */
    public function delete(UserEntity|UserBusinessRules $user): int
    {
        return User::where('id', $user->getId())
            ->first()
            ->delete();
    }
}
