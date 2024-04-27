<?php

declare(strict_types=1);

namespace App\UseCases\RoomUseCases\DeleteRoomUseCase;

use App\Domain\Interfaces\ViewModel;

interface DeleteRoomOutputPort
{
    /**
     * @param  DeleteRoomResponseModel  $response
     * @return ViewModel
     */
    public function roomDeleted(DeleteRoomResponseModel $response): ViewModel;

    /**
     * @param  DeleteRoomResponseModel  $response
     * @return ViewModel
     */
    public function noSuchRoom(DeleteRoomResponseModel $response): ViewModel;

    /**
     * @param  DeleteRoomResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     */
    public function unableToDeleteRoom(DeleteRoomResponseModel $response, \Throwable $e): ViewModel;

    /**
     * @param  DeleteRoomResponseModel  $response
     * @return ViewModel
     */
    public function permissionException(DeleteRoomResponseModel $response): ViewModel;
}
