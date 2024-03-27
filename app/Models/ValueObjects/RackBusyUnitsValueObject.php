<?php

namespace App\Models\ValueObjects;

use App\Domain\Interfaces\RackInterfaces\RackBusyUnitsInterface;
use Illuminate\Support\Facades\Validator;

/**
 * Value object for rack busy units data
 */
class RackBusyUnitsValueObject implements RackBusyUnitsInterface
{
    /**
     * @var array{
     *     front: array<int>,
     *     back: array<int>
     * }|array<null>
     */
    private array $busyUnits;

    /**
     * @param  array{
     *     front: array<int>,
     *     back: array<int>
     * }|array<null>  $busyUnits Busy units array
     *
     * @throws \DomainException $busyUnits is not valid
     */
    public function __construct(array $busyUnits)
    {
        $this->validateBusyUnits($busyUnits);
        sort($busyUnits['front']);
        sort($busyUnits['back']);
        $this->busyUnits = $busyUnits;
    }

    /**
     * @return array{
     *      front: array<int>,
     *      back: array<int>
     *  }|array<null>
     */
    public function toArray(): array
    {
        return $this->busyUnits;
    }

    /**
     * @param  bool  $side
     * @return int[]
     */
    public function getUnitsForSide(bool $side): array
    {
        if (! $side) {
            return $this->busyUnits['front'];
        }

        return $this->busyUnits['back'];
    }

    /**
     * @param  array<int>  $updatedBusyUnitsForSide
     * @param  bool  $side
     * @return RackBusyUnitsValueObject
     */
    public function updateBusyUnits(array $updatedBusyUnitsForSide, bool $side): RackBusyUnitsValueObject
    {
        sort($updatedBusyUnitsForSide);
        if (! $side) {
            $this->busyUnits['front'] = $updatedBusyUnitsForSide;
        } else {
            $this->busyUnits['back'] = $updatedBusyUnitsForSide;
        }

        return $this;
    }

    /**
     * @param  array{
     *    front: array<int>,
     *    back: array<int>
     * }  $busyUnits
     * @return void
     *
     * @throws \DomainException $busyUnits is not valid
     */
    public function validateBusyUnits(array $busyUnits): void
    {
        $validator = Validator::make($busyUnits, [
            'front' => ['present', 'array'],
            'front.*' => ['nullable', 'numeric', 'distinct', 'min:1'],
            'back' => ['present', 'array'],
            'back.*' => ['nullable', 'numeric', 'distinct', 'min:1'],
        ]);
        if ($validator->fails()) {
            throw new \DomainException('$busyUnits is not valid');
        }
    }
}
