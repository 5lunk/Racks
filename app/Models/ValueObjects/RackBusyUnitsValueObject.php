<?php

namespace App\Models\ValueObjects;

use App\Domain\Interfaces\RackInterfaces\RackBusyUnitsInterface;

class RackBusyUnitsValueObject implements RackBusyUnitsInterface
{
    private array $busyUnits;

    private array $front;

    private array $back;

    public function __construct(array $busyUnits)
    {
        $this->busyUnits = $busyUnits;
        $this->setFront();
        $this->setBack();
    }

    public function getBusyUnits(): array
    {
        return $this->busyUnits;
    }

    public function getBusyUnitsJson(): string
    {
        return json_encode($this->busyUnits);
    }

    public function getArray(bool $side): array
    {
        if (! $side) {
            return $this->front;
        }

        return $this->back;
    }

    public function setFront(): void
    {
        if (! array_key_exists('front', $this->busyUnits)) {
            $this->busyUnits['front'] = [];
        }
        $front = $this->busyUnits['front'];
        sort($front);
        $this->front = $front;
    }

    public function setBack(): void
    {
        if (! array_key_exists('back', $this->busyUnits)) {
            $this->busyUnits['back'] = [];
        }
        $back = $this->busyUnits['back'];
        sort($back);
        $this->back = $back;
    }
}