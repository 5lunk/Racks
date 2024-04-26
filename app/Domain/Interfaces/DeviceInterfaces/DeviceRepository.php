<?php

namespace App\Domain\Interfaces\DeviceInterfaces;

interface DeviceRepository
{
    /**
     * @param  DeviceEntity|DeviceBusinessRules  $device
     * @return DeviceEntity|DeviceBusinessRules
     */
    public function create(DeviceEntity|DeviceBusinessRules $device): DeviceEntity|DeviceBusinessRules;

    /**
     * @param  int  $id
     * @return DeviceEntity|DeviceBusinessRules
     */
    public function getById(int $id): DeviceEntity|DeviceBusinessRules;

    /**
     * @param  string|null  $rackId  Rack ID
     * @return array{string: string|int|bool} Rack model to array
     */
    public function getByRackId(?string $rackId): array;

    /**
     * @param  DeviceEntity|DeviceBusinessRules  $device
     * @return int
     */
    public function delete(DeviceEntity|DeviceBusinessRules $device): int;

    /**
     * @param  DeviceEntity|DeviceBusinessRules  $device
     * @return DeviceEntity|DeviceBusinessRules
     */
    public function update(DeviceEntity|DeviceBusinessRules $device): DeviceEntity|DeviceBusinessRules;

    /**
     * @param  DeviceEntity|DeviceBusinessRules  $device
     * @return int
     */
    public function updateUnits(DeviceEntity|DeviceBusinessRules $device): int;

    /**
     * @param  string|null  $id  Rack ID
     * @return array<array{
     *     region_name: string,
     *     department_name: string,
     *     site_name: string,
     *     building_name: string,
     *     room_name: string,
     *     rack_name: string
     * }> Device location array
     */
    public function getLocation(?string $id): array;

    /**
     * @return array{
     *     item_type: string,
     *     array<string>
     * } Device vendors
     */
    public function getVendors(): array;

    /**
     * @return array{
     *     item_type: string,
     *     array<string>
     * } Device models
     */
    public function getModels(): array;
}
