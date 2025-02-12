<?php

declare(strict_types=1);

namespace App\Http\Controllers\RoomControllers;

use App\Domain\Interfaces\RoomInterfaces\RoomRepository;
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
 * API Docs: @see \App\Http\Controllers\RoomControllers\Swagger\GetAllRoomsController
 */
class GetAllRoomsController extends Controller
{
    /**
     * @param  RoomRepository  $roomRepository
     */
    public function __construct(
        private readonly RoomRepository $roomRepository
    ) {
    }

    /**
     * @param  Request  $request
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request): LengthAwarePaginator
    {
        return $this->roomRepository->getAll(
            (int) $request->route('per_page')
        );
    }
}
