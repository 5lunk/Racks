<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\RackPresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\RackResources\NoSuchRackResource;
use App\Http\Resources\RackResources\RetrieveRackResource;
use App\UseCases\RackUseCases\GetRackUseCase\GetRackOutputPort;
use App\UseCases\RackUseCases\GetRackUseCase\GetRackResponseModel;

class GetRackJsonPresenter implements GetRackOutputPort
{
    /**
     * @param  GetRackResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function retrieveRack(GetRackResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    RetrieveRackResource::class, ['rack' => $response->getRack()]),
                'statusCode' => StatusCodeEnum::OK->value,
            ]
        );
    }

    /**
     * @param  GetRackResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchRack(GetRackResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchRackResource::class, ['rack' => $response->getRack()]),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }
}
