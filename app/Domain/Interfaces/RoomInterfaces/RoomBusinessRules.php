<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\RoomInterfaces;

/**
 * Business rules for Room entity
 */
interface RoomBusinessRules
{
    /**
     * Room names should not be repeated for one building (but may be repeated throughout the system)
     * A room can have either a strictly specific name or a generalized functional one.
     * In this case, the name of the room can be repeated throughout the entire project
     * but should not be repeated within the same building.
     *
     * Takes as arguments list of room names for this building, checks that it is not on the list, returns bool
     *
     * @param  string|null  $name  Room name
     * @param  array<string>  $namesList  Room names list for building
     * @return bool
     */
    public function isNameValid(?string $name, array $namesList): bool;
}
