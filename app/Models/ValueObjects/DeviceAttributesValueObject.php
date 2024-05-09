<?php

declare(strict_types=1);

namespace App\Models\ValueObjects;

use App\Domain\Interfaces\DeviceInterfaces\DeviceEntity;

/**
 * Value object for device PATCHing (reverse DTO)
 */
class DeviceAttributesValueObject
{
    /**
     * @var array<mixed>
     */
    private array $attributesForDevice = [];

    /**
     * @var DeviceEntity
     */
    private DeviceEntity $device;

    /**
     * @param  DeviceEntity  $device
     */
    public function __construct(DeviceEntity $device)
    {
        $this->device = $device;
        $this->setRackId();
        $this->setVendor();
        $this->setModel();
        $this->setUnits();
        $this->setLocation();
        $this->setUpdatedBy();
        $this->setDepartmentId();
        $this->setType();
        $this->setStatus();
        $this->setHostname();
        $this->setIp();
        $this->setPortsAmount();
        $this->setSoftwareVersion();
        $this->setPowerType();
        $this->setPowerW();
        $this->setPowerV();
        $this->setPowerACDC();
        $this->setSerialNumber();
        $this->setDescription();
        $this->setProject();
        $this->setOwnership();
        $this->setResponsible();
        $this->setFinanciallyResponsiblePerson();
        $this->setInventoryNumber();
        $this->setFixedAsset();
        $this->setLinkToDocs();
    }

    /**
     * @return void
     */
    private function setRackId(): void
    {
        $rackId = $this->device->getRackId();
        if ($rackId !== null) {
            $this->attributesForDevice += ['rack_id' => $rackId];
        }
    }

    /**
     * @return void
     */
    private function setUnits(): void
    {
        $units = $this->device->getUnits()->toArray();
        if (count($units)) {
            $this->attributesForDevice += ['units' => json_encode($units)];
        }
    }

    /**
     * @return void
     */
    private function setLocation(): void
    {
        $location = $this->device->getLocation();
        if (! is_null($location)) {
            $this->attributesForDevice += ['has_backside_location' => $location];
        }
    }

    /**
     * @return void
     */
    private function setModel(): void
    {
        $model = $this->device->getModel();
        if ($model) {
            $this->attributesForDevice += ['model' => $model];
        }
    }

    /**
     * @return void
     */
    private function setVendor(): void
    {
        $vendor = $this->device->getVendor();
        if ($vendor) {
            $this->attributesForDevice += ['vendor' => $vendor];
        }
    }

    /**
     * @return void
     */
    private function setUpdatedBy(): void
    {
        $updatedBy = $this->device->getUpdatedBy();
        if ($updatedBy) {
            $this->attributesForDevice += ['updated_by' => $updatedBy];
        }
    }

    /**
     * @return void
     */
    private function setType(): void
    {
        $type = $this->device->getType();
        if ($type) {
            $this->attributesForDevice += ['type' => $type];
        }
    }

    /**
     * @return void
     */
    private function setStatus(): void
    {
        $status = $this->device->getStatus();
        if ($status) {
            $this->attributesForDevice += ['status' => $status];
        }
    }

    /**
     * @return void
     */
    private function setHostname(): void
    {
        $hostname = $this->device->getHostname();
        if ($hostname) {
            $this->attributesForDevice += ['hostname' => $hostname];
        }
    }

    /**
     * @return void
     */
    private function setIp(): void
    {
        $ip = $this->device->getIp();
        if ($ip) {
            $this->attributesForDevice += ['ip' => $ip];
        }
    }

    /**
     * @return void
     */
    private function setPortsAmount(): void
    {
        $portsAmount = $this->device->getPortsAmount();
        if ($portsAmount) {
            $this->attributesForDevice += ['ports_amount' => $portsAmount];
        }
    }

    /**
     * @return void
     */
    private function setSoftwareVersion(): void
    {
        $softwareVersion = $this->device->getSoftwareVersion();
        if ($softwareVersion) {
            $this->attributesForDevice += ['software_version' => $softwareVersion];
        }
    }

    /**
     * @return void
     */
    private function setPowerType(): void
    {
        $powerType = $this->device->getPowerType();
        if ($powerType) {
            $this->attributesForDevice += ['power_type' => $powerType];
        }
    }

    /**
     * @return void
     */
    private function setPowerW(): void
    {
        $powerW = $this->device->getPowerW();
        if ($powerW) {
            $this->attributesForDevice += ['power_w' => $powerW];
        }
    }

    /**
     * @return void
     */
    private function setPowerV(): void
    {
        $powerV = $this->device->getPowerV();
        if ($powerV) {
            $this->attributesForDevice += ['power_v' => $powerV];
        }
    }

    /**
     * @return void
     */
    private function setPowerACDC(): void
    {
        $powerACDC = $this->device->getPowerACDC();
        if ($powerACDC) {
            $this->attributesForDevice += ['power_ac_dc' => $powerACDC];
        }
    }

    /**
     * @return void
     */
    private function setSerialNumber(): void
    {
        $serialNumber = $this->device->getSerialNumber();
        if ($serialNumber) {
            $this->attributesForDevice += ['serial_number' => $serialNumber];
        }
    }

    /**
     * @return void
     */
    private function setDescription(): void
    {
        $description = $this->device->getDescription();
        if ($description) {
            $this->attributesForDevice += ['description' => $description];
        }
    }

    /**
     * @return void
     */
    private function setProject(): void
    {
        $project = $this->device->getProject();
        if ($project) {
            $this->attributesForDevice += ['project' => $project];
        }
    }

    /**
     * @return void
     */
    private function setOwnership(): void
    {
        $ownership = $this->device->getOwnership();
        if ($ownership) {
            $this->attributesForDevice += ['ownership' => $ownership];
        }
    }

    /**
     * @return void
     */
    private function setResponsible(): void
    {
        $responsible = $this->device->getResponsible();
        if ($responsible) {
            $this->attributesForDevice += ['responsible' => $responsible];
        }
    }

    /**
     * @return void
     */
    private function setFinanciallyResponsiblePerson(): void
    {
        $financiallyResponsiblePerson = $this->device->getFinanciallyResponsiblePerson();
        if ($financiallyResponsiblePerson) {
            $this->attributesForDevice += ['financially_responsible_person' => $financiallyResponsiblePerson];
        }
    }

    /**
     * @return void
     */
    private function setInventoryNumber(): void
    {
        $inventoryNumber = $this->device->getInventoryNumber();
        if ($inventoryNumber) {
            $this->attributesForDevice += ['inventory_number' => $inventoryNumber];
        }
    }

    /**
     * @return void
     */
    private function setFixedAsset(): void
    {
        $fixedAsset = $this->device->getFixedAsset();
        if ($fixedAsset) {
            $this->attributesForDevice += ['fixed_asset' => $fixedAsset];
        }
    }

    /**
     * @return void
     */
    private function setLinkToDocs(): void
    {
        $linkToDocs = $this->device->getLinkToDocs();
        if ($linkToDocs) {
            $this->attributesForDevice += ['link_to_docs' => $linkToDocs];
        }
    }

    /**
     * @return void
     */
    private function setDepartmentId(): void
    {
        $departmentId = $this->device->getDepartmentId();
        if ($departmentId) {
            $this->attributesForDevice += ['department_id' => $departmentId];
        }
    }

    /**
     * @return array<mixed> Get attributes array
     */
    public function toArray(): array
    {
        return $this->attributesForDevice;
    }
}
