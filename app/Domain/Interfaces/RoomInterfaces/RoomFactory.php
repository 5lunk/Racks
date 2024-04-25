<?php

namespace App\Domain\Interfaces\RoomInterfaces;

use App\UseCases\RoomUseCases\CreateRoomUseCase\CreateRoomRequestModel;
use App\UseCases\RoomUseCases\UpdateRoomUseCase\UpdateRoomRequestModel;

interface RoomFactory
{
    /**
     * @param  CreateRoomRequestModel  $request
     * @return RoomEntity|RoomBusinessRules|RoomModel
     */
    public function makeFromCreateRequest(CreateRoomRequestModel $request): RoomEntity|RoomBusinessRules|RoomModel;

    /**
     * @param  UpdateRoomRequestModel  $request
     * @return RoomEntity|RoomBusinessRules|RoomModel
     */
    public function makeFromPutRequest(UpdateRoomRequestModel $request): RoomEntity|RoomBusinessRules|RoomModel;
}
