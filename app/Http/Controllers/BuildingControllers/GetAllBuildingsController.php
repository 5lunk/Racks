<?php

declare(strict_types=1);

namespace App\Http\Controllers\BuildingControllers;

use App\Domain\Interfaces\BuildingInterfaces\BuildingRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/*
|--------------------------------------------------------------------------
| RAPID APPROACH
|--------------------------------------------------------------------------
|
| Not much business logic, not likely to change.
|
*/

/**
 * API Docs: @see \App\Http\Controllers\BuildingControllers\Swagger\GetAllBuildingsController
 */
class GetAllBuildingsController extends Controller
{
    /**
     * @param  BuildingRepository  $buildingRepository
     */
    public function __construct(
        private readonly BuildingRepository $buildingRepository
    ) {
    }

    /**
     * @param  Request  $request
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request): LengthAwarePaginator
    {
        return $this->buildingRepository->getAll(
            (int) $request->route('per_page')
        );
    }
}
