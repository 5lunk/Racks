<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\RegionPresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\RegionResources\NoSuchRegionResource;
use App\Http\Resources\RegionResources\RetrieveRegionResource;
use App\UseCases\RegionUseCases\GetRegionUseCase\GetRegionOutputPort;
use App\UseCases\RegionUseCases\GetRegionUseCase\GetRegionResponseModel;

class GetRegionJsonPresenter implements GetRegionOutputPort
{
    /**
     * @param  GetRegionResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function retrieveRegion(GetRegionResponseModel $response): ViewModel
    {
        return App()->makeWith(JsonResourceViewModel::class,
            [
                'resource' => App()->makeWith(
                    RetrieveRegionResource::class, ['region' => $response->getRegion()]),
                'statusCode' => StatusCodeEnum::OK->value,
            ]
        );
    }

    /**
     * @param  GetRegionResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchRegion(GetRegionResponseModel $response): ViewModel
    {
        return App()->makeWith(JsonResourceViewModel::class,
            [
                'resource' => App()->makeWith(
                    NoSuchRegionResource::class, ['region' => $response->getRegion()]),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }
}
