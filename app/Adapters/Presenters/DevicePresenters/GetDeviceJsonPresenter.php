<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\DevicePresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\DeviceResources\NoSuchDeviceResource;
use App\Http\Resources\DeviceResources\RetrieveDeviceResource;
use App\UseCases\DeviceUseCases\GetDeviceUseCase\GetDeviceOutputPort;
use App\UseCases\DeviceUseCases\GetDeviceUseCase\GetDeviceResponseModel;

class GetDeviceJsonPresenter implements GetDeviceOutputPort
{
    /**
     * @param  GetDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function retrieveDevice(GetDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    RetrieveDeviceResource::class, ['device' => $response->getDevice()]),
                'statusCode' => StatusCodeEnum::OK->value,
            ]
        );
    }

    /**
     * @param  GetDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchDevice(GetDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchDeviceResource::class, ['device' => $response->getDevice()]),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }
}
