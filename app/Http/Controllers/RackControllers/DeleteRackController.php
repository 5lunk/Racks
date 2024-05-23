<?php

declare(strict_types=1);

namespace App\Http\Controllers\RackControllers;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\RackRequests\DeleteRackRequest;
use App\UseCases\RackUseCases\DeleteRackUseCase\DeleteRackInputPort;
use App\UseCases\RackUseCases\DeleteRackUseCase\DeleteRackRequestModel;
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
 * API Docs: @see \App\Http\Controllers\RackControllers\Swagger\DeleteRackController
 */
class DeleteRackController extends Controller
{
    /**
     * @param  DeleteRackInputPort  $interactor
     */
    public function __construct(
        private readonly DeleteRackInputPort $interactor,
    ) {
    }

    /**
     * @param  DeleteRackRequest  $request
     * @return JsonResponse|null
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __invoke(DeleteRackRequest $request): ?JsonResponse
    {
        $viewModel = $this->interactor->deleteRack(
            resolve_proxy(DeleteRackRequestModel::class,
                ['id' => (int) $request->route('id'), 'user' => $request->user()])
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
