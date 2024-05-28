<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\SitePresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\SiteResources\NoSuchSiteResource;
use App\Http\Resources\SiteResources\PermissionExceptionResource;
use App\Http\Resources\SiteResources\SiteUpdatedResource;
use App\Http\Resources\SiteResources\UnableToUpdateSiteResource;
use App\UseCases\SiteUseCases\UpdateSiteUseCase\UpdateSiteOutputPort;
use App\UseCases\SiteUseCases\UpdateSiteUseCase\UpdateSiteResponseModel;

class UpdateSiteJsonPresenter implements UpdateSiteOutputPort
{
    /**
     * @param  UpdateSiteResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function siteUpdated(UpdateSiteResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    SiteUpdatedResource::class,
                    ['site' => $response->getSite()]
                ),
                'statusCode' => StatusCodeEnum::ACCEPTED->value,
            ]
        );
    }

    /**
     * @param  UpdateSiteResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchSite(UpdateSiteResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchSiteResource::class,
                    ['site' => $response->getSite()]
                ),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }

    /**
     * @param  UpdateSiteResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function permissionException(UpdateSiteResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    PermissionExceptionResource::class,
                    ['site' => $response->getSite()]
                ),
                'statusCode' => StatusCodeEnum::FORBIDDEN->value,
            ]
        );
    }

    /**
     * @param  UpdateSiteResponseModel  $response
     * @param  \Throwable  $e
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     * @throws \Throwable
     */
    public function unableToUpdateSite(UpdateSiteResponseModel $response, \Throwable $e): ViewModel
    {
        if (config('app.debug')) {
            throw $e;
        }

        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    UnableToUpdateSiteResource::class,
                    ['e' => $e]
                ),
                'statusCode' => StatusCodeEnum::INTERNAL_SERVER_ERROR->value,
            ]
        );
    }
}
