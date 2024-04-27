<?php

declare(strict_types=1);

namespace App\UseCases\RoomUseCases\GetRoomUseCase;

class GetRoomRequestModel
{
    /**
     * @param  int  $id
     */
    public function __construct(
        private readonly int $id
    ) {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
