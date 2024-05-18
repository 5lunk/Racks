<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\BuildingInterfaces;

/**
 * Business rules for Building entity
 */
interface BuildingBusinessRules
{
    /**
     * Building names should not be repeated for one site (but may be repeated throughout the system)
     * A building can have either a strictly specific name or a generalized functional one.
     * In this case, the name of the building can be repeated throughout the entire project
     * but should not be repeated within the same site.
     *
     * Takes as arguments list of building names for this site, checks that it is not on the list, returns bool
     *
     * @param  string|null  $name  Building name
     * @param  array<string>  $namesList  Array of names
     * @return bool
     */
    public function isNameValid(?string $name, array $namesList): bool;
}
