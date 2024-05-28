<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\DevicePresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\DeviceResources\DeviceUpdatedResource;
use App\Http\Resources\DeviceResources\DeviceUpdateFailedResource;
use App\Http\Resources\DeviceResources\NoSuchDeviceResource;
use App\Http\Resources\DeviceResources\NoSuchUnitsResource;
use App\Http\Resources\DeviceResources\PermissionExceptionResource;
use App\Http\Resources\DeviceResources\UnableToUpdateDeviceResource;
use App\Http\Resources\DeviceResources\UnitsAreBusyResource;
use App\UseCases\DeviceUseCases\UpdateDeviceUseCase\UpdateDeviceOutputPort;
use App\UseCases\DeviceUseCases\UpdateDeviceUseCase\UpdateDeviceResponseModel;

class UpdateDeviceJsonPresenter implements UpdateDeviceOutputPort
{
    /**
     * @param  UpdateDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function deviceUpdated(UpdateDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    DeviceUpdatedResource::class,
                    ['device' => $response->getDevice()]
                ),
                'statusCode' => StatusCodeEnum::ACCEPTED->value,
            ]
        );
    }

    /**
     * @param  UpdateDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchUnits(UpdateDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchUnitsResource::class,
                    ['device' => $response->getDevice()]
                ),
                'statusCode' => StatusCodeEnum::BAD_REQUEST->value,
            ]
        );
    }

    /**
     * @param  UpdateDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function unitsAreBusy(UpdateDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    UnitsAreBusyResource::class,
                    ['device' => $response->getDevice()]
                ),
                'statusCode' => StatusCodeEnum::BAD_REQUEST->value,
            ]
        );
    }

    /**
     * @param  UpdateDeviceResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function updateFailed(UpdateDeviceResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    DeviceUpdateFailedResource::class,
                    ['e' => $e]
                ),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  UpdateDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchDevice(UpdateDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchDeviceResource::class,
                    ['device' => $response->getDevice()]
                ),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }

    /**
     * @param  UpdateDeviceResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function unableToUpdateDevice(UpdateDeviceResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    UnableToUpdateDeviceResource::class,
                    ['e' => $e]
                ),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  UpdateDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissionException(UpdateDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    PermissionExceptionResource::class,
                    ['building' => $response->getDevice()]
                ),
                'statusCode' => StatusCodeEnum::FORBIDDEN->value,
            ]
        );
    }
}
