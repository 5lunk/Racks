<?php

namespace App\Repositories;

use App\Domain\Interfaces\RegionInterfaces\RegionBusinessRules;
use App\Domain\Interfaces\RegionInterfaces\RegionEntity;
use App\Domain\Interfaces\RegionInterfaces\RegionModel;
use App\Domain\Interfaces\RegionInterfaces\RegionRepository;
use App\Models\Region;
use Illuminate\Pagination\LengthAwarePaginator;

class RegionDatabaseRepository implements RegionRepository
{
    /**
     * @param  int  $id
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function getById(int $id): RegionEntity|RegionModel|RegionBusinessRules
    {
        return Region::where('id', $id)
            ->get()
            ->firstOrFail();
    }

    /**
     * @return array<mixed>
     */
    public function getTreeView(): array
    {
        return Region::with(
            'children',
            'children:id,name as department_name,region_id',
            'children.children:id,name as site_name,department_id',
            'children.children.children:id,name as building_name,site_id',
            'children.children.children.children:id,name as room_name,building_id',
            'children.children.children.children.children:id,name as rack_name,room_id'
        )
            ->select('id', 'name as region_name')
            ->orderBy('id', 'asc')
            ->get()
            ->toArray();
    }

    /**
     * @param  RegionEntity|RegionModel|RegionBusinessRules  $region
     * @return bool
     */
    public function exists(RegionEntity|RegionModel|RegionBusinessRules $region): bool
    {
        return Region::where([
            'name' => $region->getName(),
        ])->exists();
    }

    /**
     * @param  RegionEntity|RegionModel|RegionBusinessRules  $region
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function create(RegionEntity|RegionModel|RegionBusinessRules $region): RegionEntity|RegionModel|RegionBusinessRules
    {
        return Region::create([
            'name' => $region->getName(),
        ]);
    }

    /**
     * @param  RegionEntity|RegionModel|RegionBusinessRules  $region
     * @return int
     */
    public function delete(RegionEntity|RegionModel|RegionBusinessRules $region): int
    {
        return Region::where('id', $region->getId())
            ->first()
            ->delete();
    }

    /**
     * @param  RegionEntity|RegionModel|RegionBusinessRules  $region
     * @return RegionEntity|RegionModel|RegionBusinessRules
     */
    public function update(RegionEntity|RegionModel|RegionBusinessRules $region): RegionEntity|RegionModel|RegionBusinessRules
    {
        return tap(Region::where('id', $region->getId())
            ->first())
            ->update([
                'name' => $region->getName(),
            ]);
    }

    /**
     * @param  string|null  $perPage
     * @return LengthAwarePaginator
     */
    public function getAll(?string $perPage): LengthAwarePaginator
    {
        return Region::paginate($perPage);
    }
}
