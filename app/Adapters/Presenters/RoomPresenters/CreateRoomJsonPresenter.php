<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\RoomPresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\RoomResources\NoSuchBuildingResource;
use App\Http\Resources\RoomResources\PermissionExceptionResource;
use App\Http\Resources\RoomResources\RoomCreatedResource;
use App\Http\Resources\RoomResources\RoomNameExceptionResource;
use App\Http\Resources\RoomResources\UnableToCreateRoomResource;
use App\UseCases\RoomUseCases\CreateRoomUseCase\CreateRoomOutputPort;
use App\UseCases\RoomUseCases\CreateRoomUseCase\CreateRoomResponseModel;

class CreateRoomJsonPresenter implements CreateRoomOutputPort
{
    /**
     * @param  CreateRoomResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function roomCreated(CreateRoomResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    RoomCreatedResource::class, ['room' => $response->getRoom()]),
                'statusCode' => StatusCodeEnum::CREATED->value,
            ]
        );
    }

    /**
     * @param  CreateRoomResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchBuilding(CreateRoomResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchBuildingResource::class, ['room' => $response->getRoom()]),
                'statusCode' => StatusCodeEnum::BAD_REQUEST->value,
            ]
        );
    }

    /**
     * @param  CreateRoomResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function roomNameException(CreateRoomResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    RoomNameExceptionResource::class, ['room' => $response->getRoom()]),
                'statusCode' => StatusCodeEnum::BAD_REQUEST->value,
            ]
        );
    }

    /**
     * @param  CreateRoomResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function unableToCreateRoom(CreateRoomResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    UnableToCreateRoomResource::class, ['e' => $e]),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  CreateRoomResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissionException(CreateRoomResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    PermissionExceptionResource::class, ['room' => $response->getRoom()]),
                'statusCode' => StatusCodeEnum::FORBIDDEN->value,
            ]
        );
    }
}
