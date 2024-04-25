<?php

namespace App\Domain\Interfaces\RegionInterfaces;

use App\Models\Region;

/**
 * Region entity
 *
 * Region as a location for departments
 * For properties @see Region
 * For business rules @see RegionBusinessRules
 */
interface RegionEntity
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
     * @return string
     */
    public function getCreatedAt(): string;

    /**
     * @return string
     */
    public function getUpdatedAt(): string;
}
