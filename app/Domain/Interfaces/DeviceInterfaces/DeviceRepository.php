<?php

namespace App\Domain\Interfaces\DeviceInterfaces;

interface DeviceRepository
{
    /**
     * @param  DeviceEntity|DeviceBusinessRules|DeviceModel  $device
     * @return DeviceEntity|DeviceBusinessRules|DeviceModel
     */
    public function create(DeviceEntity|DeviceBusinessRules|DeviceModel $device): DeviceEntity|DeviceBusinessRules|DeviceModel;

    /**
     * @param  int  $id
     * @return DeviceEntity|DeviceBusinessRules|DeviceModel
     */
    public function getById(int $id): DeviceEntity|DeviceBusinessRules|DeviceModel;

    /**
     * @param  string|null  $rackId  Rack ID
     * @return array{string: string|int|bool} Rack model to array
     */
    public function getByRackId(?string $rackId): array;

    /**
     * @param  DeviceEntity|DeviceBusinessRules|DeviceModel  $device
     * @return int
     */
    public function delete(DeviceEntity|DeviceBusinessRules|DeviceModel $device): int;

    /**
     * @param  DeviceEntity|DeviceBusinessRules|DeviceModel  $device
     * @return DeviceEntity|DeviceBusinessRules|DeviceModel
     */
    public function update(DeviceEntity|DeviceBusinessRules|DeviceModel $device): DeviceEntity|DeviceBusinessRules|DeviceModel;

    /**
     * @param  DeviceEntity|DeviceBusinessRules|DeviceModel  $device
     * @return int
     */
    public function updateUnits(DeviceEntity|DeviceBusinessRules|DeviceModel $device): int;

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
