<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\RoomInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RoomRepository
{
    /**
     * @param  int  $id
     * @return RoomEntity|RoomBusinessRules
     */
    public function getById(int $id): RoomEntity|RoomBusinessRules;

    /**
     * @param  int  $buildingId
     * @return array<string>
     */
    public function getNamesListByBuildingId(int $buildingId): array;

    /**
     * @param  RoomEntity|RoomBusinessRules  $room
     * @return RoomEntity|RoomBusinessRules
     */
    public function create(RoomEntity|RoomBusinessRules $room): RoomEntity|RoomBusinessRules;

    /**
     * @param  RoomEntity|RoomBusinessRules  $room
     * @return RoomEntity|RoomBusinessRules
     */
    public function update(RoomEntity|RoomBusinessRules $room): RoomEntity|RoomBusinessRules;

    /**
     * @param  RoomEntity|RoomBusinessRules  $room
     * @return bool
     */
    public function delete(RoomEntity|RoomBusinessRules $room): bool;

    /**
     * @return void
     */
    public function lockTable(): void;

    /**
     * @param  int|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?int $perPage): LengthAwarePaginator;

    /**
     * @param  int|null  $id
     * @return array<array{
     *      region_name: string,
     *      department_name: string,
     *      site_name: string,
     *      building_name: string
     * }>
     */
    public function getLocation(?int $id): array;
}
