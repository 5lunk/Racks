<?php

namespace App\Domain\Interfaces\BuildingInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface BuildingRepository
{
    /**
     * @param  int  $id
     * @return BuildingEntity|BuildingBusinessRules
     */
    public function getById(int $id): BuildingEntity|BuildingBusinessRules;

    /**
     * @return array<string> $items
     */
    public function getNamesListBySiteId(int $siteId): array;

    /**
     * @param  BuildingEntity|BuildingBusinessRules  $building
     * @return BuildingEntity|BuildingBusinessRules
     */
    public function create(BuildingEntity|BuildingBusinessRules $building): BuildingEntity|BuildingBusinessRules;

    /**
     * @param  BuildingEntity|BuildingBusinessRules  $building
     * @return BuildingEntity|BuildingBusinessRules
     */
    public function update(BuildingEntity|BuildingBusinessRules $building): BuildingEntity|BuildingBusinessRules;

    /**
     * @param  BuildingEntity|BuildingBusinessRules  $building
     * @return int
     */
    public function delete(BuildingEntity|BuildingBusinessRules $building): int;

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
