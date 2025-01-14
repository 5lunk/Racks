<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\RoomPresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\RoomResources\NoSuchRoomResource;
use App\Http\Resources\RoomResources\PermissionExceptionResource;
use App\Http\Resources\RoomResources\RoomDeletedResource;
use App\Http\Resources\RoomResources\UnableToDeleteRoomResource;
use App\UseCases\RoomUseCases\DeleteRoomUseCase\DeleteRoomOutputPort;
use App\UseCases\RoomUseCases\DeleteRoomUseCase\DeleteRoomResponseModel;

class DeleteRoomJsonPresenter implements DeleteRoomOutputPort
{
    /**
     * @param  DeleteRoomResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function roomDeleted(DeleteRoomResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    RoomDeletedResource::class,
                    ['room' => $response->getRoom()]
                ),
                'statusCode' => StatusCodeEnum::NO_CONTENT->value,
            ]
        );
    }

    /**
     * @param  DeleteRoomResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchRoom(DeleteRoomResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchRoomResource::class,
                    ['room' => $response->getRoom()]
                ),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }

    /**
     * @param  DeleteRoomResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function unableToDeleteRoom(DeleteRoomResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    UnableToDeleteRoomResource::class,
                    ['e' => $e]
                ),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  DeleteRoomResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissionException(DeleteRoomResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    PermissionExceptionResource::class,
                    ['room' => $response->getRoom()]
                ),
                'statusCode' => StatusCodeEnum::FORBIDDEN->value,
            ]
        );
    }
}
