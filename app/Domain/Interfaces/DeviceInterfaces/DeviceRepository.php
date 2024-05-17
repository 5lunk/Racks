<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\DeviceInterfaces;

interface DeviceRepository
{
    /**
     * @param  DeviceEntity&DeviceBusinessRules  $device
     * @return DeviceEntity&DeviceBusinessRules
     */
    public function create(DeviceEntity&DeviceBusinessRules $device): DeviceEntity&DeviceBusinessRules;

    /**
     * @param  int  $id
     * @return DeviceEntity&DeviceBusinessRules
     */
    public function getById(int $id): DeviceEntity&DeviceBusinessRules;

    /**
     * @param  int|null  $rackId  Rack ID
     * @return array{string: string|int|bool} Rack model to array
     */
    public function getByRackId(?int $rackId): array;

    /**
     * @param  DeviceEntity&DeviceBusinessRules  $device
     * @return bool
     */
    public function delete(DeviceEntity&DeviceBusinessRules $device): bool;

    /**
     * @param  DeviceEntity&DeviceBusinessRules  $device
     * @return DeviceEntity&DeviceBusinessRules
     */
    public function update(DeviceEntity&DeviceBusinessRules $device): DeviceEntity&DeviceBusinessRules;

    /**
     * @param  DeviceEntity&DeviceBusinessRules  $device
     * @return bool
     */
    public function updateUnits(DeviceEntity&DeviceBusinessRules $device): bool;

    /**
     * @param  int|null  $id  Rack ID
     * @return array<array{
     *     region_name: string,
     *     department_name: string,
     *     site_name: string,
     *     building_name: string,
     *     room_name: string,
     *     rack_name: string
     * }> Device location array
     */
    public function getLocation(?int $id): array;

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
