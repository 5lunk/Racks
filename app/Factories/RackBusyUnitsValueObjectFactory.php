<?php

declare(strict_types=1);

namespace App\Factories;

use App\Domain\Interfaces\RackInterfaces\RackBusyUnitsFactory;
use App\Domain\Interfaces\RackInterfaces\RackBusyUnitsInterface;
use App\Models\ValueObjects\RackBusyUnitsValueObject;

class RackBusyUnitsValueObjectFactory implements RackBusyUnitsFactory
{
    /**
     * @param  array{front: array<int>, back: array<int>}|array<null>  $attributes
     * @return RackBusyUnitsInterface
     */
    public function make(array $attributes = []): RackBusyUnitsInterface
    {
        return new RackBusyUnitsValueObject($attributes);
    }
}
