<?php

namespace App\Domain\Interfaces\SiteInterfaces;

use App\Models\Site;
use App\Models\ValueObjects\SiteAttributesValueObject;

/**
 * Site entity
 *
 * Site as a location for buildings
 * For properties @see Site
 * For business rules @see SiteBusinessRules
 */
interface SiteEntity
{
    /**
     * @return int
     */
    public function getId(): int;

    /**
     * @return string|null
     */
    public function getName(): ?string;

    /**
     * @param  string|null  $name
     * @return void
     */
    public function setName(?string $name): void;

    /**
     * @return string|null
     */
    public function getDescription(): ?string;

    /**
     * @param  string|null  $description
     * @return void
     */
    public function setDescription(?string $description): void;

    /**
     * @return int|null
     */
    public function getDepartmentId(): ?int;

    /**
     * @param  int|null  $departmentId
     * @return void
     *
     * @throws \DomainException $departmentId <= 0
     */
    public function setDepartmentId(?int $departmentId): void;

    /**
     * @return SiteAttributesValueObject
     */
    public function getAttributeSet(): SiteAttributesValueObject;

    /**
     * @return string|null
     */
    public function getUpdatedBy(): ?string;

    /**
     * @param  string|null  $updatedBy
     * @return void
     */
    public function setUpdatedBy(?string $updatedBy): void;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;
}
