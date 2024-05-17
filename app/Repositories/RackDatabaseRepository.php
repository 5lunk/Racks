<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Interfaces\RackInterfaces\RackBusinessRules;
use App\Domain\Interfaces\RackInterfaces\RackEntity;
use App\Domain\Interfaces\RackInterfaces\RackRepository;
use App\Models\Rack;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class RackDatabaseRepository implements RackRepository
{
    /**
     * @param  int  $id
     * @return RackEntity&RackBusinessRules
     */
    public function getById(int $id): RackEntity&RackBusinessRules
    {
        return Rack::where('id', $id)
            ->get()
            ->firstOrFail();
    }

    /**
     * @param  RackEntity&RackBusinessRules  $rack
     * @return RackEntity&RackBusinessRules
     *
     * @throws BindingResolutionException
     */
    public function create(RackEntity&RackBusinessRules $rack): RackEntity&RackBusinessRules
    {
        return Rack::create($rack->getAttributeSet()->toArray());
    }

    /**
     * @param  RackEntity&RackBusinessRules  $rack
     * @return bool
     *
     * @throws BindingResolutionException
     */
    public function updateBusyUnits(RackEntity&RackBusinessRules $rack): bool
    {
        return Rack::where('id', $rack->getId())
            ->first()
            ->update([
                'busy_units' => $rack->getBusyUnits()->toArray(),
            ]);
    }

    /**
     * @param  int  $id
     * @return void
     */
    public function lockById(int $id): void
    {
        DB::table('racks')
            ->where('id', $id)
            ->sharedLock();
    }

    /**
     * @param  RackEntity&RackBusinessRules  $rack
     * @return bool
     */
    public function delete(RackEntity&RackBusinessRules $rack): bool
    {
        return Rack::where('id', $rack->getId())
            ->first()
            ->delete();
    }

    /**
     * @param  RackEntity&RackBusinessRules  $rack
     * @return RackEntity&RackBusinessRules
     *
     * @throws BindingResolutionException
     */
    public function update(RackEntity&RackBusinessRules $rack): RackEntity&RackBusinessRules
    {

        return tap(Rack::where('id', $rack->getId())
            ->first())
            ->update(
                $rack->getAttributeSet()->toArray()
            );
    }

    /**
     * @param  int  $roomId
     * @return array<string>
     */
    public function getNamesListByRoomId(int $roomId): array
    {
        return Rack::where('room_id', $roomId)
            ->pluck('name')
            ->toArray();
    }

    /**
     * @param  int|null  $id
     * @return array<mixed>
     */
    public function getLocation(?int $id): array
    {
        return DB::table('racks')
            ->where('racks.id', $id)
            ->select(
                'regions.name as region_name',
                'departments.name as department_name',
                'sites.name as site_name',
                'buildings.name as building_name',
                'rooms.name as room_name',
            )
            ->join('rooms', 'racks.room_id', '=', 'rooms.id')
            ->join('buildings', 'rooms.building_id', '=', 'buildings.id')
            ->join('sites', 'buildings.site_id', '=', 'sites.id')
            ->join('departments', 'sites.department_id', '=', 'departments.id')
            ->join('regions', 'departments.region_id', '=', 'regions.id')
            ->get()
            ->toArray();
    }

    /**
     * @return array<string>
     */
    public function getVendors(): array
    {
        return DB::table('racks')
            ->select('vendor')
            ->distinct()
            ->pluck('vendor')
            ->toArray();
    }

    /**
     * @return array<string>
     */
    public function getModels(): array
    {
        return DB::table('racks')
            ->select('model')
            ->distinct()
            ->pluck('model')
            ->toArray();
    }

    /**
     * @param  int|null  $perPage
     * @param  array<string>  $columns
     * @return LengthAwarePaginator
     */
    public function getAll(?int $perPage, array $columns): LengthAwarePaginator
    {
        return Rack::paginate($perPage, $columns);
    }
}
