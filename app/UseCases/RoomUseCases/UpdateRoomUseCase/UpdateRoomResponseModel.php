<?php

declare(strict_types=1);

namespace App\UseCases\RoomUseCases\UpdateRoomUseCase;

use App\Domain\Interfaces\RoomInterfaces\RoomEntity;

class UpdateRoomResponseModel
{
    /**
     * @param  RoomEntity  $room
     */
    public function __construct(
        private readonly RoomEntity $room
    ) {
    }

    /**
     * @return RoomEntity
     */
    public function getRoom(): RoomEntity
    {
        return $this->room;
    }
}
