<?php

namespace App\Http\Resources\RoomResources;

use App\Domain\Interfaces\RoomInterfaces\RoomEntity;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="NoSuchRoomForRoomResponse",
 *     title="No such room",
 *
 *         @OA\Property(
 *             property="message",
 *             type="string",
 *             example="No such room"
 *         )
 *     )
 * )
 */
class NoSuchRoomResource extends JsonResource
{
    protected RoomEntity $room;

    public function __construct(RoomEntity $room)
    {
        parent::__construct($room);
        $this->room = $room;
    }

    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [
            'message' => 'No such room',
        ];
    }
}