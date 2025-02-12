<?php

declare(strict_types=1);

namespace App\UseCases\RoomUseCases\DeleteRoomUseCase;

use App\Models\User;

class DeleteRoomRequestModel
{
    /**
     * @param  int  $id
     * @param  User  $user
     */
    public function __construct(
        private readonly int $id,
        private readonly User $user
    ) {
    }

    /**
     * @return string
     */
    public function getUserName(): string
    {
        return $this->user['name'];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
