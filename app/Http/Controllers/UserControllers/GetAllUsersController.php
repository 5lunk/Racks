<?php

declare(strict_types=1);

namespace App\Http\Controllers\UserControllers;

use App\Domain\Interfaces\UserInterfaces\UserRepository;
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

class GetAllUsersController extends Controller
{
    /**
     * @param  UserRepository  $userRepository
     */
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }

    /**
     * @param  Request  $request
     * @return LengthAwarePaginator
     */
    public function __invoke(Request $request): LengthAwarePaginator
    {
        return $this->userRepository->getAll(
            (int) $request->route('per_page')
        );
    }
}
