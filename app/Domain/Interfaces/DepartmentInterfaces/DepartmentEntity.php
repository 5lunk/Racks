<?php

namespace App\Domain\Interfaces\DepartmentInterfaces;

use App\Models\Department;

/**
 * Department entity
 *
 * Department as a location for sites
 * For properties @see Department
 * For business rules @see DepartmentBusinessRules
 */
interface DepartmentEntity
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param  string  $name
     * @return void
     */
    public function setName(string $name): void;

    /**
     * @return int|null
     */
    public function getRegionId(): ?int;

    /**
     * @param  int|null  $regionId
     * @return void
     *
     * @throws \DomainException $regionId <= 0
     */
    public function setRegionId(?int $regionId): void;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;
}
