<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\RegionInterfaces;

use Illuminate\Pagination\LengthAwarePaginator;

interface RegionRepository
{
    /**
     * @param  int  $id
     * @return RegionEntity|RegionBusinessRules
     */
    public function getById(int $id): RegionEntity|RegionBusinessRules;

    /**
     * @param  RegionEntity|RegionBusinessRules  $region
     * @return bool
     */
    public function exists(RegionEntity|RegionBusinessRules $region): bool;

    /**
     * @param  RegionEntity|RegionBusinessRules  $region
     * @return RegionEntity|RegionBusinessRules
     */
    public function create(RegionEntity|RegionBusinessRules $region): RegionEntity|RegionBusinessRules;

    /**
     * @param  RegionEntity|RegionBusinessRules  $region
     * @return bool
     */
    public function delete(RegionEntity|RegionBusinessRules $region): bool;

    /**
     * @param  RegionEntity|RegionBusinessRules  $region
     * @return RegionEntity|RegionBusinessRules
     */
    public function update(RegionEntity|RegionBusinessRules $region): RegionEntity|RegionBusinessRules;

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
     * @param  int|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?int $perPage): LengthAwarePaginator;
}
