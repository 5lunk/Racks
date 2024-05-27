<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Interfaces\BuildingInterfaces\BuildingBusinessRules;
use App\Domain\Interfaces\BuildingInterfaces\BuildingEntity;
use App\Domain\Interfaces\BuildingInterfaces\BuildingRepository;
use App\Models\Building;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class BuildingDatabaseRepository implements BuildingRepository
{
    /**
     * @param  int  $id
     * @return BuildingEntity&BuildingBusinessRules
     */
    public function getById(int $id): BuildingEntity&BuildingBusinessRules
    {
        return Building::where('id', $id)
            ->get()
            ->firstOrFail();
    }

    /**
     * @return array<string> $items
     */
    public function getNamesListBySiteId(int $siteId): array
    {
        return Building::where('site_id', $siteId)
            ->pluck('name')
            ->toArray();
    }

    /**
     * @param  BuildingEntity&BuildingBusinessRules  $building
     * @return BuildingEntity&BuildingBusinessRules
     *
     * @throws BindingResolutionException
     */
    public function create(BuildingEntity&BuildingBusinessRules $building): BuildingEntity&BuildingBusinessRules
    {
        return Building::create($building->getAttributeSet()->toArray());
    }

    /**
     * @param  BuildingEntity&BuildingBusinessRules  $building
     * @return BuildingEntity&BuildingBusinessRules
     *
     * @throws BindingResolutionException
     */
    public function update(BuildingEntity&BuildingBusinessRules $building): BuildingEntity&BuildingBusinessRules
    {
        return tap(Building::where('id', $building->getId())
            ->first())
            ->update(
                $building->getAttributeSet()->toArray()
            );
    }

    /**
     * @param  BuildingEntity&BuildingBusinessRules  $building
     * @return bool
     */
    public function delete(BuildingEntity&BuildingBusinessRules $building): bool
    {
        return Building::where('id', $building->getId())
            ->first()
            ->delete();
    }

    /**
     * @param  int  $id
     * @return array<array{
     *     region_name: string,
     *     department_name: string,
     *     site_name: string
     * }>
     */
    public function getLocation(int $id): array
    {
        return DB::table('buildings')
            ->where('buildings.id', $id)
            ->select(
                'regions.name as region_name',
                'departments.name as department_name',
                'sites.name as site_name',
            )
            ->join('sites', 'buildings.site_id', '=', 'sites.id')
            ->join('departments', 'sites.department_id', '=', 'departments.id')
            ->join('regions', 'departments.region_id', '=', 'regions.id')
            ->get()
            ->toArray();
    }

    /**
     * @param  int|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?int $perPage): LengthAwarePaginator
    {
        return Building::paginate($perPage);
    }
}
