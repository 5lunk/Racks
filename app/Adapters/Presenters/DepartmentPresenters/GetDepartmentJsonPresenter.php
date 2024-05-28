<?php

declare(strict_types=1);

namespace App\Adapters\Presenters\DepartmentPresenters;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Domain\Interfaces\ViewModel;
use App\Enums\StatusCodeEnum;
use App\Http\Resources\DepartmentResources\NoSuchDepartmentResource;
use App\Http\Resources\DepartmentResources\RetrieveDepartmentResource;
use App\UseCases\DepartmentUseCases\GetDepartmentUseCase\GetDepartmentOutputPort;
use App\UseCases\DepartmentUseCases\GetDepartmentUseCase\GetDepartmentResponseModel;

class GetDepartmentJsonPresenter implements GetDepartmentOutputPort
{
    /**
     * @param  GetDepartmentResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function retrieveDepartment(GetDepartmentResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    RetrieveDepartmentResource::class,
                    ['department' => $response->getDepartment()]
                ),
                'statusCode' => StatusCodeEnum::OK->value,
            ]
        );
    }

    /**
     * @param  GetDepartmentResponseModel  $response
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function noSuchDepartment(GetDepartmentResponseModel $response): ViewModel
    {
        return resolve_proxy(JsonResourceViewModel::class,
            [
                'resource' => resolve_proxy(
                    NoSuchDepartmentResource::class,
                    ['department' => $response->getDepartment()]
                ),
                'statusCode' => StatusCodeEnum::NOT_FOUND->value,
            ]
        );
    }
}
