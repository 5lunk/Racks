<?php

namespace App\Domain\Interfaces\DeviceInterfaces;

interface DeviceUnitsInterface
{
    /**
     * @return array<int> Units array
     */
    public function toArray(): array;

    /**
     * @param  array<int>  $units
     * @return bool
     *
     * @throws \DomainException $units is not valid
     */
    public function validateUnits(array $units): bool;
}
