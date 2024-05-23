<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\SitePresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\SiteResources\NoSuchDepartmentResource;
use App\Http\Resources\SiteResources\PermissionExceptionResource;
use App\Http\Resources\SiteResources\SiteCreatedResource;
use App\Http\Resources\SiteResources\UnableToCreateSiteResource;
use App\UseCases\SiteUseCases\CreateSiteUseCase\CreateSiteOutputPort;
use App\UseCases\SiteUseCases\CreateSiteUseCase\CreateSiteResponseModel;

class CreateSiteJsonPresenter implements CreateSiteOutputPort
{
    /**
     * @param  CreateSiteResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function siteCreated(CreateSiteResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    SiteCreatedResource::class, ['site' => $response->getSite()]),
                'statusCode' => StatusCodeEnum::CREATED->value,
            ]
        );
    }

    /**
     * @param  CreateSiteResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function unableToCreateSite(CreateSiteResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    UnableToCreateSiteResource::class, ['e' => $e]),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }

    /**
     * @param  CreateSiteResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissionException(CreateSiteResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    PermissionExceptionResource::class, ['site' => $response->getSite()]),
                'statusCode' => StatusCodeEnum::FORBIDDEN->value,
            ]
        );
    }

    /**
     * @param  CreateSiteResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchDepartment(CreateSiteResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchDepartmentResource::class, ['site' => $response->getSite()]),
                'statusCode' => StatusCodeEnum::BAD_REQUEST->value,
            ]
        );
    }
}
