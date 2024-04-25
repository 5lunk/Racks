<?php

namespace App\Domain\Interfaces\BuildingInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface BuildingRepository
{
    /**
     * @param  int  $id
     * @return BuildingEntity|BuildingModel
     */
    public function getById(int $id): BuildingEntity|BuildingModel;

    /**
     * @return array<string> $items
     */
    public function getNamesListBySiteId(int $siteId): array;

    /**
     * @param  BuildingEntity  $building
     * @return BuildingEntity|BuildingModel
     */
    public function create(BuildingEntity $building): BuildingEntity|BuildingModel;

    /**
     * @param  BuildingEntity  $building
     * @return BuildingEntity|BuildingModel
     */
    public function update(BuildingEntity $building): BuildingEntity|BuildingModel;

    /**
     * @param  BuildingEntity|BuildingModel  $building
     * @return int
     */
    public function delete(BuildingEntity|BuildingModel $building): int;

    /**
     * @param  string|null  $id
     * @return array<array{
     *     region_name: string,
     *     department_name: string,
     *     site_name: string
     * }>
     */
    public function getLocation(?string $id): array;

    /**
     * @return void
     */
    public function lockTable(): void;

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator;
}
