<?php

declare(strict_types=1);

namespace App\UseCases\RoomUseCases\CreateRoomUseCase;

use App\Domain\Interfaces\ViewModel;

interface CreateRoomInputPort
{
    /**
     * @param  CreateRoomRequestModel  $request
     * @return ViewModel
     */
    public function createRoom(CreateRoomRequestModel $request): ViewModel;
}
