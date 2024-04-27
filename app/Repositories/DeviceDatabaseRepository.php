<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Domain\Interfaces\DeviceInterfaces\DeviceBusinessRules;
use App\Domain\Interfaces\DeviceInterfaces\DeviceEntity;
use App\Domain\Interfaces\DeviceInterfaces\DeviceRepository;
use App\Models\Device;
use Illuminate\Support\Facades\DB;

class DeviceDatabaseRepository implements DeviceRepository
{
    /**
     * @param  int  $id
     * @return DeviceEntity|DeviceBusinessRules
     */
    public function getById(int $id): DeviceEntity|DeviceBusinessRules
    {
        return Device::where('id', $id)
            ->get()
            ->firstOrFail();
    }

    /**
     * @param  int|null  $rackId
     * @return array<mixed>
     */
    public function getByRackId(?int $rackId): array
    {
        return Device::where('rack_id', $rackId)
            ->get()
            ->toArray();
    }

    /**
     * @param  DeviceEntity|DeviceBusinessRules  $device
     * @return bool
     */
    public function updateUnits(DeviceEntity|DeviceBusinessRules $device): bool
    {
        return Device::where('id', $device->getId())
            ->first()
            ->update([
                'units' => $device->getUnits()->toArray(),
            ]);
    }

    /**
     * @param  DeviceEntity|DeviceBusinessRules  $device
     * @return bool
     */
    public function delete(DeviceEntity|DeviceBusinessRules $device): bool
    {
        return Device::where('id', $device->getId())
            ->first()
            ->delete();
    }

    /**
     * @param  DeviceEntity|DeviceBusinessRules  $device
     * @return DeviceEntity|DeviceBusinessRules
     */
    public function update(DeviceEntity|DeviceBusinessRules $device): DeviceEntity|DeviceBusinessRules
    {
        return tap(Device::where('id', $device->getId())
            ->first())
            ->update(
                $device->getAttributeSet()->toArray()
            );
    }

    /**
     * @param  DeviceEntity|DeviceBusinessRules  $device
     * @return DeviceEntity|DeviceBusinessRules
     */
    public function create(DeviceEntity|DeviceBusinessRules $device): DeviceEntity|DeviceBusinessRules
    {
        return Device::create($device->getAttributeSet()->toArray());
    }

    /**
     * @param  int|null  $id
     * @return array<mixed>
     */
    public function getLocation(?int $id): array
    {
        return DB::table('devices')
            ->where('devices.id', $id)
            ->select(
                'regions.name as region_name',
                'departments.name as department_name',
                'sites.name as site_name',
                'buildings.name as building_name',
                'rooms.name as room_name',
                'racks.name as rack_name'
            )
            ->join('racks', 'devices.rack_id', '=', 'racks.id')
            ->join('rooms', 'racks.room_id', '=', 'rooms.id')
            ->join('buildings', 'rooms.building_id', '=', 'buildings.id')
            ->join('sites', 'buildings.site_id', '=', 'sites.id')
            ->join('departments', 'sites.department_id', '=', 'departments.id')
            ->join('regions', 'departments.region_id', '=', 'regions.id')
            ->get()
            ->toArray();
    }

    /**
     * @return array<mixed>
     */
    public function getVendors(): array
    {
        return DB::table('devices')
            ->select('vendor')
            ->distinct()
            ->pluck('vendor')
            ->toArray();
    }

    /**
     * @return array<mixed>
     */
    public function getModels(): array
    {
        return DB::table('devices')
            ->select('model')
            ->distinct()
            ->pluck('model')
            ->toArray();
    }
}
