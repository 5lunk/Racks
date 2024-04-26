<?php

namespace App\Factories;

use App\Domain\Interfaces\DeviceInterfaces\DeviceUnitsFactory;
use App\Models\ValueObjects\DeviceUnitsValueObject;

class DeviceUnitsValueObjectFactory implements DeviceUnitsFactory
{
    /**
     * @param  array<mixed>  $attributes
     * @return DeviceUnitsValueObject
     *
     * @throws \Exception
     */
    public function make(array $attributes = []): DeviceUnitsValueObject
    {
        return new DeviceUnitsValueObject($attributes);
    }
}
