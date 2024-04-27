<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\DeviceInterfaces;

use App\Models\ValueObjects\DeviceUnitsValueObject;

interface DeviceUnitsFactory
{
    /**
     * @param  array<int>  $attributes
     * @return DeviceUnitsValueObject
     */
    public function make(array $attributes = []): DeviceUnitsValueObject;
}
