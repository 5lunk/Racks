<?php

declare(strict_types=1);

namespace App\UseCases\RoomUseCases\GetRoomUseCase;

use App\Domain\Interfaces\RoomInterfaces\RoomRepository;
use App\Domain\Interfaces\ViewModel;

class GetRoomInteractor implements GetRoomInputPort
{
    /**
     * @param  GetRoomOutputPort  $output
     * @param  RoomRepository  $roomRepository
     */
    public function __construct(
        private readonly GetRoomOutputPort $output,
        private readonly RoomRepository $roomRepository
    ) {
    }

    /**
     * @param  GetRoomRequestModel  $request
     * @return ViewModel
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function getRoom(GetRoomRequestModel $request): ViewModel
    {
        // Try to get room
        try {
            $room = $this->roomRepository->getById($request->getId());
        } catch (\Exception $e) {
            return $this->output->noSuchRoom(
                resolve_proxy(GetRoomResponseModel::class, ['room' => null])
            );
        }

        return $this->output->retrieveRoom(
            resolve_proxy(GetRoomResponseModel::class, ['room' => $room])
        );
    }
}
