<?php

namespace App\Domain\Interfaces\RegionInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RegionRepository
{
    /**
     * @param  int  $id
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function getById(int $id): RegionEntity|RegionModel|RegionBusinessRules;

    /**
     * @param  RegionEntity|RegionModel|RegionBusinessRules  $region
     * @return bool
     */
    public function exists(RegionEntity|RegionModel|RegionBusinessRules $region): bool;

    /**
     * @param  RegionEntity|RegionModel|RegionBusinessRules  $region
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function create(RegionEntity|RegionModel|RegionBusinessRules $region): RegionEntity|RegionModel|RegionBusinessRules;

    /**
     * @param  RegionEntity|RegionModel|RegionBusinessRules  $region
     * @return int
     */
    public function delete(RegionEntity|RegionModel|RegionBusinessRules $region): int;

    /**
     * @param  RegionEntity|RegionModel|RegionBusinessRules  $region
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function update(RegionEntity|RegionModel|RegionBusinessRules $region): RegionEntity|RegionModel|RegionBusinessRules;

    /**
     * @return array{
     *     id: int,
     *     region_name: string,
     *     children: array{
     *         id: int,
     *         department_name: string,
     *         children: array{
     *             id: int,
     *             site_name: string,
     *             children: array{
     *                 id: int,
     *                 building_name: string,
     *                 children: array{
     *                     id: int,
     *                     room_name: string,
     *                     children: array{
     *                         id: int,
     *                         rack_name: string,
     *                     }
     *                 }
     *             }
     *         }
     *     }
     * } Tree structure
     */
    public function getTreeView(): array;

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator;
}
