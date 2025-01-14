<?php

declare(strict_types=1);

namespace App\Http\Controllers\DepartmentControllers;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\DepartmentRequest\GetDepartmentRequest;
use App\UseCases\DepartmentUseCases\GetDepartmentUseCase\GetDepartmentInputPort;
use App\UseCases\DepartmentUseCases\GetDepartmentUseCase\GetDepartmentRequestModel;
use Illuminate\Http\JsonResponse;

/*
|--------------------------------------------------------------------------
| SIMPLIFIED ADAPTATION OF CA
|--------------------------------------------------------------------------
|
| Thick interactors, a lot of resources.
|
*/

/**
 * API Docs: @see \App\Http\Controllers\DepartmentControllers\Swagger\GetDepartmentController
 */
class GetDepartmentController extends Controller
{
    /**
     * @param  GetDepartmentInputPort  $interactor
     */
    public function __construct(
        private readonly GetDepartmentInputPort $interactor,
    ) {
    }

    /**
     * @param  GetDepartmentRequest  $request
     * @return JsonResponse|null
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __invoke(GetDepartmentRequest $request): ?JsonResponse
    {
        $viewModel = $this->interactor->getDepartment(
            resolve_proxy(GetDepartmentRequestModel::class, ['id' => (int) $request->route('id')])
        );
        if ($viewModel instanceof JsonResourceViewModel) {
            return response()->json(
                ['data' => $viewModel->getResource()->toArray($request)],
                $viewModel->getStatusCode()
            );
        }

        return null;
    }
}
