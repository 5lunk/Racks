<?php

declare(strict_types=1);

namespace App\UseCases\RoomUseCases\GetRoomUseCase;

use App\Domain\Interfaces\ViewModel;

interface GetRoomOutputPort
{
    /**
     * @param  GetRoomResponseModel  $response
     * @return ViewModel
     */
    public function retrieveRoom(GetRoomResponseModel $response): ViewModel;

    /**
     * @param  GetRoomResponseModel  $response
     * @return ViewModel
     */
    public function noSuchRoom(GetRoomResponseModel $response): ViewModel;
}
