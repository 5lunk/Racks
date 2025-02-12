<?php

declare(strict_types=1);

namespace App\Models\HelperObjects;

use App\Domain\Interfaces\BuildingInterfaces\BuildingEntity;

/**
 * Helper object for building PATCHing
 */
class BuildingAttributesHelperObject
{
    /**
     * @var array<mixed>
     */
    private array $attributesForBuilding = [];

    /**
     * @var BuildingEntity
     */
    private BuildingEntity $building;

    /**
     * @param  BuildingEntity  $building
     */
    public function __construct(BuildingEntity $building)
    {
        $this->building = $building;
        $this->setName();
        $this->setUpdatedBy();
        $this->setSiteId();
        $this->setDescription();
        $this->setDepartmentId();
    }

    /**
     * @return void
     */
    private function setName(): void
    {
        $name = $this->building->getName();
        if ($name) {
            $this->attributesForBuilding += ['name' => $name];
        }
    }

    /**
     * @return void
     */
    private function setSiteId(): void
    {
        $siteId = $this->building->getSiteId();
        if ($siteId) {
            $this->attributesForBuilding += ['site_id' => $siteId];
        }
    }

    /**
     * @return void
     */
    private function setUpdatedBy(): void
    {
        $updatedBy = $this->building->getUpdatedBy();
        if ($updatedBy) {
            $this->attributesForBuilding += ['updated_by' => $updatedBy];
        }
    }

    /**
     * @return void
     */
    private function setDescription(): void
    {
        $description = $this->building->getDescription();
        if ($description) {
            $this->attributesForBuilding += ['description' => $description];
        }
    }

    /**
     * @return void
     */
    private function setDepartmentId(): void
    {
        $departmentId = $this->building->getDepartmentId();
        if ($departmentId) {
            $this->attributesForBuilding += ['department_id' => $departmentId];
        }
    }

    /**
     * @return array<mixed> Get attributes array
     */
    public function toArray(): array
    {
        return $this->attributesForBuilding;
    }
}
