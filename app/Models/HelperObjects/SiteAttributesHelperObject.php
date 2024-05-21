<?php

declare(strict_types=1);

namespace App\Models\HelperObjects;

use App\Domain\Interfaces\SiteInterfaces\SiteEntity;

/**
 * Helper object for site PATCHing
 */
class SiteAttributesHelperObject
{
    /**
     * @var array<mixed>
     */
    private array $attributesForSite = [];

    /**
     * @var SiteEntity
     */
    private SiteEntity $site;

    /**
     * @param  SiteEntity  $site
     */
    public function __construct(SiteEntity $site)
    {
        $this->site = $site;
        $this->setName();
        $this->setUpdatedBy();
        $this->setDescription();
        $this->setDepartmentId();
    }

    /**
     * @return void
     */
    private function setName(): void
    {
        $name = $this->site->getName();
        if ($name) {
            $this->attributesForSite += ['name' => $name];
        }
    }

    /**
     * @return void
     */
    private function setUpdatedBy(): void
    {
        $updatedBy = $this->site->getUpdatedBy();
        if ($updatedBy) {
            $this->attributesForSite += ['updated_by' => $updatedBy];
        }
    }

    /**
     * @return void
     */
    private function setDescription(): void
    {
        $description = $this->site->getDescription();
        if ($description) {
            $this->attributesForSite += ['description' => $description];
        }
    }

    /**
     * @return void
     */
    private function setDepartmentId(): void
    {
        $departmentId = $this->site->getDepartmentId();
        if ($departmentId) {
            $this->attributesForSite += ['department_id' => $departmentId];
        }
    }

    /**
     * @return array<mixed> Get attributes array
     */
    public function toArray(): array
    {
        return $this->attributesForSite;
    }
}
