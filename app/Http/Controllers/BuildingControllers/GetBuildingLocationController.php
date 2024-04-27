<?php

declare(strict_types=1);

namespace App\Http\Controllers\BuildingControllers;

use App\Domain\Interfaces\BuildingInterfaces\BuildingRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| RAPID APPROACH
|--------------------------------------------------------------------------
|
| Not much business logic, not likely to change.
|
*/

/**
 * API Docs: @see \App\Http\Controllers\BuildingControllers\Swagger\GetBuildingLocationController
 */
class GetBuildingLocationController extends Controller
{
    /**
     * @param  BuildingRepository  $buildingRepository
     */
    public function __construct(
        private readonly BuildingRepository $buildingRepository,
    ) {
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        try {
            $buildingLocation = $this->buildingRepository->getLocation((int) $request->route('id'));

            return response()->json(
                ['data' => $buildingLocation[0]]
            );
        } catch (\Exception $e) {
            return response()->json(
                ['data' => ['message' => 'No such building']], 404
            );
        }
    }
}
