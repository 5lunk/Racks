<?php

declare(strict_types=1);

namespace App\Http\Controllers\RoomControllers;

use App\Adapters\ViewModels\JsonResourceViewModel;
use App\Http\Controllers\Controller;
use App\Http\Requests\RoomRequests\UpdateRoomRequest;
use App\UseCases\RoomUseCases\UpdateRoomUseCase\UpdateRoomInputPort;
use App\UseCases\RoomUseCases\UpdateRoomUseCase\UpdateRoomRequestModel;
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
 * API Docs: @see \App\Http\Controllers\RoomControllers\Swagger\UpdateRoomController
 */
class UpdateRoomController extends Controller
{
    /**
     * @param  UpdateRoomInputPort  $interactor
     */
    public function __construct(
        private readonly UpdateRoomInputPort $interactor,
    ) {
    }

    /**
     * @param  UpdateRoomRequest  $request
     * @return JsonResponse|null
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function __invoke(UpdateRoomRequest $request): ?JsonResponse
    {
        $viewModel = $this->interactor->updateRoom(
            resolve_proxy(
                UpdateRoomRequestModel::class,
                ['attributes' => $request->validated(), 'id' => (int) $request->route('id'), 'user' => $request->user()]
            )
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
