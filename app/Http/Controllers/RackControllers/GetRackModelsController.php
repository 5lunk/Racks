<?php

declare(strict_types=1);

namespace App\Http\Controllers\RackControllers;

use App\Domain\Interfaces\RackInterfaces\RackRepository;
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
 * API Docs: @see \App\Http\Controllers\RackControllers\Swagger\GetRackModelsController
 */
class GetRackModelsController extends Controller
{
    /**
     * @param  RackRepository  $rackRepository
     */
    public function __construct(
        private readonly RackRepository $rackRepository,
    ) {
    }

    /**
     * @param  Request  $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $vendors = array_values(array_filter($this->rackRepository->getModels()));
        sort($vendors);

        return response()->json([
            'data' => [
                'item_type' => 'rack_model',
                'items' => $vendors,
            ],
        ]);
    }
}
