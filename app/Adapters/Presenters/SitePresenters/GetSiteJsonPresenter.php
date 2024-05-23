<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\SitePresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\SiteResources\NoSuchSiteResource;
use App\Http\Resources\SiteResources\RetrieveSiteResource;
use App\UseCases\SiteUseCases\GetSiteUseCase\GetSiteOutputPort;
use App\UseCases\SiteUseCases\GetSiteUseCase\GetSiteResponseModel;

class GetSiteJsonPresenter implements GetSiteOutputPort
{
    /**
     * @param  GetSiteResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function retrieveSite(GetSiteResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    RetrieveSiteResource::class, ['site' => $response->getSite()]),
                'statusCode' => StatusCodeEnum::OK->value,
            ]
        );
    }

    /**
     * @param  GetSiteResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchSite(GetSiteResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchSiteResource::class, ['site' => $response->getSite()]),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }
}
