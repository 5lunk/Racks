<?php

declare(strict_types=1);

namespace App\Models\Traits;

trait UniqueNameableTrait
{
    /**
     * @see BuildingBusinessRules::isNameValid()
     * @see RoomBusinessRules::isNameValid()
     * @see RackBusinessRules::isNameValid()
     *
     * @param  string|null  $name
     * @param  array<string>  $namesList
     * @return bool
     */
    public function isNameValid(?string $name, array $namesList): bool
    {
        if (in_array($name, $namesList)) {
            return false;
        }

        return true;
    }
}
