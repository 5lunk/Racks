<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\RackPresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\RackResources\NoSuchRackResource;
use App\Http\Resources\RackResources\PermissionExceptionResource;
use App\Http\Resources\RackResources\RackNameExceptionResource;
use App\Http\Resources\RackResources\RackUpdatedResource;
use App\Http\Resources\RackResources\UnableToUpdateRackResource;
use App\UseCases\RackUseCases\UpdateRackUseCase\UpdateRackOutputPort;
use App\UseCases\RackUseCases\UpdateRackUseCase\UpdateRackResponseModel;

class UpdateRackJsonPresenter implements UpdateRackOutputPort
{
    /**
     * @param  UpdateRackResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function rackUpdated(UpdateRackResponseModel $response): ViewModel
    {
        return App()->makeWith(JsonResourceViewModel::class,
            [
                'resource' => App()->makeWith(
                    RackUpdatedResource::class, ['rack' => $response->getRack()]),
                'statusCode' => StatusCodeEnum::ACCEPTED->value,
            ]
        );
    }

    /**
     * @param  UpdateRackResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchRack(UpdateRackResponseModel $response): ViewModel
    {
        return App()->makeWith(JsonResourceViewModel::class,
            [
                'resource' => App()->makeWith(
                    NoSuchRackResource::class, ['rack' => $response->getRack()]),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }

    /**
     * @param  UpdateRackResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function rackNameException(UpdateRackResponseModel $response): ViewModel
    {
        return App()->makeWith(JsonResourceViewModel::class,
            [
                'resource' => App()->makeWith(
                    RackNameExceptionResource::class, ['rack' => $response->getRack()]),
                'statusCode' => StatusCodeEnum::BAD_REQUEST->value,
            ]
        );
    }

    /**
     * @param  UpdateRackResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function unableToUpdateRack(UpdateRackResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return App()->makeWith(JsonResourceViewModel::class,
            [
                'resource' => App()->makeWith(
                    UnableToUpdateRackResource::class, ['e' => $e]),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  UpdateRackResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissionException(UpdateRackResponseModel $response): ViewModel
    {
        return App()->makeWith(JsonResourceViewModel::class,
            [
                'resource' => App()->makeWith(
                    PermissionExceptionResource::class, ['rack' => $response->getRack()]),
                'statusCode' => StatusCodeEnum::FORBIDDEN->value,
            ]
        );
    }
}
