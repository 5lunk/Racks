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
     * @return void
     *
     * @throws \Exception $units is not valid
     */
    public function validateUnits(array $units): void;
}
