<?php

declare(strict_types=1);

namespace App\UseCases\RoomUseCases\GetRoomUseCase;

use App\Domain\Interfaces\ViewModel;

interface GetRoomInputPort
{
    /**
     * @param  GetRoomRequestModel  $request
     * @return ViewModel
     */
    public function getRoom(GetRoomRequestModel $request): ViewModel;
}
