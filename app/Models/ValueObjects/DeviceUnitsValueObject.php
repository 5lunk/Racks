<?php

declare(strict_types=1);

namespace App\Models\ValueObjects;

use App\Domain\Interfaces\DeviceInterfaces\DeviceUnitsInterface;
use App\Http\Validators\Rules\DeviceUnitsRule;
use Illuminate\Support\Facades\Validator;

/**
 * Device units value object
 * Units occupied by the device
 */
class DeviceUnitsValueObject implements DeviceUnitsInterface
{
    /**
     * @var array<int>
     */
    private readonly array $units;

    /**
     * @param  array<int>  $units
     *
     * @throws \Exception $units is not valid
     */
    public function __construct(array $units)
    {
        if (! $this->validateUnits($units)) {
            throw new \DomainException('$units is not valid');
        }
        $this->units = $units;
    }

    /**
     * @return array<int>
     */
    public function toArray(): array
    {
        return $this->units;
    }

    /**
     * @param  array<int>  $units
     * @return bool
     *
     * @throws \DomainException $units is not valid
     */
    public function validateUnits(array $units): bool
    {
        sort($units);
        $validator = Validator::make(['units' => $units], [
            'units' => [new DeviceUnitsRule(), 'array'],
        ]);
        if ($validator->fails()) {
            return false;
        }

        return true;
    }

    /**
     * @param  DeviceUnitsValueObject  $unitsObject
     * @return bool
     */
    public function equalTo(DeviceUnitsValueObject $unitsObject): bool
    {
        return $this->units === $unitsObject->toArray();
    }
}
