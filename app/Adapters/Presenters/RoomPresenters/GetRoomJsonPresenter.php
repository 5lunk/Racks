<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\RoomPresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\RoomResources\NoSuchRoomResource;
use App\Http\Resources\RoomResources\RetrieveRoomResource;
use App\UseCases\RoomUseCases\GetRoomUseCase\GetRoomOutputPort;
use App\UseCases\RoomUseCases\GetRoomUseCase\GetRoomResponseModel;

class GetRoomJsonPresenter implements GetRoomOutputPort
{
    /**
     * @param  GetRoomResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function retrieveRoom(GetRoomResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    RetrieveRoomResource::class,
                    ['room' => $response->getRoom()]
                ),
                'statusCode' => StatusCodeEnum::OK->value,
            ]
        );
    }

    /**
     * @param  GetRoomResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchRoom(GetRoomResponseModel $response): ViewModel
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
}
