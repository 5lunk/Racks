<?php

namespace App\Domain\Interfaces\RackInterfaces;

use App\Models\ValueObjects\RackBusyUnitsValueObject;

/**
 * Rack busy units
 */
interface RackBusyUnitsInterface
{
    /**
     * @param  bool  $side  Rack side (back - true)
     * @return array<int> Busy units for side
     */
    public function getUnitsForSide(bool $side): array;

    /**
     * @param  array<int>  $updatedBusyUnitsForSide
     * @param  bool  $side
     * @return RackBusyUnitsValueObject
     */
    public function updateBusyUnits(array $updatedBusyUnitsForSide, bool $side): RackBusyUnitsValueObject;

    /**
     * @return array{
     *     front: array<int>,
     *     back: array<int>
     * } Busy units array
     */
    public function toArray(): array;

    /**
     * @param  array{
     *    front: array<int>,
     *    back: array<int>
     * }  $busyUnits
     * @return bool
     */
    public function validateBusyUnits(array $busyUnits): bool;
}
