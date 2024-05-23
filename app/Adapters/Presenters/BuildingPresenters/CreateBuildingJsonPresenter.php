<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\BuildingPresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\BuildingResources\BuildingCreatedResource;
use App\Http\Resources\BuildingResources\BuildingNameExceptionResource;
use App\Http\Resources\BuildingResources\NoSuchSiteResource;
use App\Http\Resources\BuildingResources\PermissionExceptionResource;
use App\Http\Resources\BuildingResources\UnableToCreateBuildingResource;
use App\UseCases\BuildingUseCases\CreateBuildingUseCase\CreateBuildingOutputPort;
use App\UseCases\BuildingUseCases\CreateBuildingUseCase\CreateBuildingResponseModel;

class CreateBuildingJsonPresenter implements CreateBuildingOutputPort
{
    /**
     * @param  CreateBuildingResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function buildingCreated(CreateBuildingResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    BuildingCreatedResource::class, ['building' => $response->getBuilding()]),
                'statusCode' => StatusCodeEnum::CREATED->value,
            ]
        );
    }

    /**
     * @param  CreateBuildingResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchSite(CreateBuildingResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchSiteResource::class, ['building' => $response->getBuilding()]),
                'statusCode' => StatusCodeEnum::BAD_REQUEST->value,
            ]
        );
    }

    /**
     * @param  CreateBuildingResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function buildingNameException(CreateBuildingResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    BuildingNameExceptionResource::class, ['building' => $response->getBuilding()]),
                'statusCode' => StatusCodeEnum::BAD_REQUEST->value,
            ]
        );
    }

    /**
     * @param  CreateBuildingResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function unableToCreateBuilding(CreateBuildingResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    UnableToCreateBuildingResource::class, ['e' => $e]),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  CreateBuildingResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissionException(CreateBuildingResponseModel $response): ViewModel
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
