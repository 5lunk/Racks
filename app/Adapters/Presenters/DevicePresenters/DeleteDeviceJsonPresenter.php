<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\DevicePresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\DeviceResources\DeviceDeletedResource;
use App\Http\Resources\DeviceResources\DeviceDeletionFailedResource;
use App\Http\Resources\DeviceResources\NoSuchDeviceResource;
use App\Http\Resources\DeviceResources\PermissionExceptionResource;
use App\Http\Resources\DeviceResources\UnableToDeleteDeviceResource;
use App\UseCases\DeviceUseCases\DeleteDeviceUseCase\DeleteDeviceOutputPort;
use App\UseCases\DeviceUseCases\DeleteDeviceUseCase\DeleteDeviceResponseModel;

class DeleteDeviceJsonPresenter implements DeleteDeviceOutputPort
{
    /**
     * @param  DeleteDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function deviceDeleted(DeleteDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    DeviceDeletedResource::class, ['device' => $response->getDevice()]),
                'statusCode' => StatusCodeEnum::NO_CONTENT->value,
            ]
        );
    }

    /**
     * @param  DeleteDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchDevice(DeleteDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchDeviceResource::class, ['device' => $response->getDevice()]),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }

    /**
     * @param  DeleteDeviceResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function deletionFailed(DeleteDeviceResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    DeviceDeletionFailedResource::class, ['e' => $e]),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  DeleteDeviceResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function unableToDeleteDevice(DeleteDeviceResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    UnableToDeleteDeviceResource::class, ['e' => $e]),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  DeleteDeviceResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissionException(DeleteDeviceResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    PermissionExceptionResource::class, ['device' => $response->getDevice()]),
                'statusCode' => StatusCodeEnum::FORBIDDEN->value,
            ]
        );
    }
}
