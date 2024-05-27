<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\RackInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RackRepository
{
    /**
     * @param  RackEntity&RackBusinessRules  $rack
     * @return RackEntity&RackBusinessRules
     */
    public function create(RackEntity&RackBusinessRules $rack): RackEntity&RackBusinessRules;

    /**
     * @param  int  $id
     * @return RackEntity&RackBusinessRules
     */
    public function getById(int $id): RackEntity&RackBusinessRules;

    /**
     * @param  RackEntity&RackBusinessRules  $rack
     * @return bool
     */
    public function updateBusyUnits(RackEntity&RackBusinessRules $rack): bool;

    /**
     * @param  RackEntity&RackBusinessRules  $rack
     * @return bool
     */
    public function delete(RackEntity&RackBusinessRules $rack): bool;

    /**
     * @param  RackEntity&RackBusinessRules  $rack
     * @return RackEntity&RackBusinessRules
     */
    public function update(RackEntity&RackBusinessRules $rack): RackEntity&RackBusinessRules;

    /**
     * @param  int  $roomId  Room ID
     * @return array<string> Rack names list for room
     */
    public function getNamesListByRoomId(int $roomId): array;

    /**
     * Rack location
     * Region>Department>Site>Building>Room
     *
     * @param  int|null  $id  Rack ID
     * @return array<array{
     *     region_name: string,
     *     department_name: string,
     *     site_name: string,
     *     building_name: string,
     *     room_name: string,
     * }> Rack location
     */
    public function getLocation(?int $id): array;

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
     * @param  int|null  $perPage  Racks per page
     * @param  array<string>  $columns  Columns needed
     * @return LengthAwarePaginator Paginator
     */
    public function getAll(?int $perPage, array $columns): LengthAwarePaginator;
}
