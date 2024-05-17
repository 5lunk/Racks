<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\BuildingInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface BuildingRepository
{
    /**
     * @param  int  $id
     * @return BuildingEntity&BuildingBusinessRules
     */
    public function getById(int $id): BuildingEntity&BuildingBusinessRules;

    /**
     * @return array<string> $items
     */
    public function getNamesListBySiteId(int $siteId): array;

    /**
     * @param  BuildingEntity&BuildingBusinessRules  $building
     * @return BuildingEntity&BuildingBusinessRules
     */
    public function create(BuildingEntity&BuildingBusinessRules $building): BuildingEntity&BuildingBusinessRules;

    /**
     * @param  BuildingEntity&BuildingBusinessRules  $building
     * @return BuildingEntity&BuildingBusinessRules
     */
    public function update(BuildingEntity&BuildingBusinessRules $building): BuildingEntity&BuildingBusinessRules;

    /**
     * @param  BuildingEntity&BuildingBusinessRules  $building
     * @return bool
     */
    public function delete(BuildingEntity&BuildingBusinessRules $building): bool;

    /**
     * @param  int|null  $id
     * @return array<array{
     *     region_name: string,
     *     department_name: string,
     *     site_name: string
     * }>
     */
    public function getLocation(?int $id): array;

    /**
     * @param  int|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?int $perPage): LengthAwarePaginator;
}
