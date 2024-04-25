<?php

namespace App\Domain\Interfaces\RackInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RackRepository
{
    /**
     * @param  RackEntity|RackModel  $rack
     * @return RackEntity|RackModel
     */
    public function create(RackEntity|RackModel $rack): RackEntity|RackModel;

    /**
     * @param  int  $id
     * @return RackEntity|RackBusinessRules|RackModel
     */
    public function getById(int $id): RackEntity|RackBusinessRules|RackModel;

    /**
     * @param  int  $id
     * @return void
     */
    public function lockById(int $id): void;

    /**
     * @param  RackEntity|RackModel  $rack
     * @return int
     */
    public function updateBusyUnits(RackEntity|RackModel $rack): int;

    /**
     * @param  RackEntity|RackModel  $rack
     * @return int
     */
    public function delete(RackEntity|RackModel $rack): int;

    /**
     * @param  RackEntity|RackModel  $rack
     * @return RackEntity|RackModel
     */
    public function update(RackEntity|RackModel $rack): RackEntity|RackModel;

    /**
     * @param  int  $roomId  Room ID
     * @return array<string> Rack names list for room
     */
    public function getNamesListByRoomId(int $roomId): array;

    /**
     * @return void
     */
    public function lockTable(): void;

    /**
     * Rack location
     * Region>Department>Site>Building>Room
     *
     * @return array<array{
     *     region_name: string,
     *     department_name: string,
     *     site_name: string,
     *     building_name: string,
     *     room_name: string,
     * }> Rack location
     */
    public function getLocation(?string $id): array;

    /**
     * All rack vendors
     *
     * @return array{
     *     item_type: string,
     *     array<string>
     * } Rack vendors
     */
    public function getVendors(): array;

    /**
     * All rack models
     *
     * @return array{
     *     item_type: string,
     *     array<string>
     * } Rack models
     */
    public function getModels(): array;

    /**
     * @param  string|null  $perPage  Racks per page
     * @param  array<string>  $columns  Columns needed
     * @return LengthAwarePaginator Paginator
     */
    public function getAll(?string $perPage, array $columns): LengthAwarePaginator;
}
