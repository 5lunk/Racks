<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\BuildingInterfaces;

use App\Models\Building;
use App\Models\HelperObjects\BuildingAttributesHelperObject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Building entity
 *
 * Building as a location for rooms with racks
 * For properties @see Building
 * For business rules @see BuildingBusinessRules
 */
interface BuildingEntity
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
    public function getSiteId(): ?int;

    /**
     * @param  int|null  $siteId
     * @return void
     *
     * @throws \DomainException $siteId <= 0
     */
    public function setSiteId(?int $siteId): void;

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
     * @return string|null
     */
    public function getUpdatedBy(): ?string;

    /**
     * @param  string|null  $updatedBy
     * @return void
     */
    public function setUpdatedBy(?string $updatedBy): void;

    /**
     * @return BuildingAttributesHelperObject
     */
    public function getAttributeSet(): BuildingAttributesHelperObject;

    /**
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;

    /**
     * @return BelongsTo
     */
    public function site(): BelongsTo;

    /**
     * @return BelongsTo
     */
    public function department(): BelongsTo;

    /**
     * @return HasMany
     */
    public function children(): HasMany;

    /**
     * @return array<mixed>
     */
    public function toArray(): array;

    /**
     * @param  array<mixed>|string  $with  Reload param
     * @return Model|null ?Model
     */
    public function fresh($with): ?Model;
}
