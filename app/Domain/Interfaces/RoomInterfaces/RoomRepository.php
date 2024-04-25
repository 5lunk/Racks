<?php

namespace App\Domain\Interfaces\RoomInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RoomRepository
{
    /**
     * @param  int  $id
     * @return RoomEntity|RoomBusinessRules|RoomModel
     */
    public function getById(int $id): RoomEntity|RoomBusinessRules|RoomModel;

    /**
     * @param  int  $buildingId
     * @return array<string>
     */
    public function getNamesListByBuildingId(int $buildingId): array;

    /**
     * @param  RoomEntity|RoomBusinessRules|RoomModel  $room
     * @return RoomEntity|RoomBusinessRules|RoomModel
     */
    public function create(RoomEntity|RoomBusinessRules|RoomModel $room): RoomEntity|RoomBusinessRules|RoomModel;

    /**
     * @param  RoomEntity|RoomBusinessRules|RoomModel  $room
     * @return RoomEntity|RoomBusinessRules|RoomModel
     */
    public function update(RoomEntity|RoomBusinessRules|RoomModel $room): RoomEntity|RoomBusinessRules|RoomModel;

    /**
     * @param  RoomEntity|RoomBusinessRules|RoomModel  $room
     * @return int
     */
    public function delete(RoomEntity|RoomBusinessRules|RoomModel $room): int;

    /**
     * @return void
     */
    public function lockTable(): void;

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator;

    /**
     * @param  string|null  $id
     * @return array<array{
     *      region_name: string,
     *      department_name: string,
     *      site_name: string,
     *      building_name: string
     * }>
     */
    public function getLocation(?string $id): array;
}
