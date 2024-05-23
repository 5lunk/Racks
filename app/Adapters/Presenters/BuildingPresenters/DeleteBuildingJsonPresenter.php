<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\BuildingPresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\BuildingResources\BuildingDeletedResource;
use App\Http\Resources\BuildingResources\NoSuchBuildingResource;
use App\Http\Resources\BuildingResources\PermissionExceptionResource;
use App\Http\Resources\BuildingResources\UnableToDeleteBuildingResource;
use App\UseCases\BuildingUseCases\DeleteBuildingUseCase\DeleteBuildingOutputPort;
use App\UseCases\BuildingUseCases\DeleteBuildingUseCase\DeleteBuildingResponseModel;

class DeleteBuildingJsonPresenter implements DeleteBuildingOutputPort
{
    /**
     * @param  DeleteBuildingResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function buildingDeleted(DeleteBuildingResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    BuildingDeletedResource::class, ['building' => $response->getBuilding()]),
                'statusCode' => StatusCodeEnum::NO_CONTENT->value,
            ]
        );
    }

    /**
     * @param  DeleteBuildingResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchBuilding(DeleteBuildingResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchBuildingResource::class, ['building' => $response->getBuilding()]),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }

    /**
     * @param  DeleteBuildingResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function unableToDeleteBuilding(DeleteBuildingResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    UnableToDeleteBuildingResource::class, ['e' => $e]),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  DeleteBuildingResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissionException(DeleteBuildingResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    PermissionExceptionResource::class, ['building' => $response->getBuilding()]),
                'statusCode' => StatusCodeEnum::FORBIDDEN->value,
            ]
        );
    }
}
