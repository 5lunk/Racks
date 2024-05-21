<?php

declare(strict_types=1);

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
    private readonly array $busyUnits;

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
        if (! $this->validateBusyUnits($busyUnits)) {
            throw new \DomainException('$busyUnits is not valid');
        }
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
    public function getNewBusyUnits(array $updatedBusyUnitsForSide, bool $side): RackBusyUnitsValueObject
    {
        sort($updatedBusyUnitsForSide);
        if (! $side) {
            $front = $updatedBusyUnitsForSide;
            $back = $this->busyUnits['back'];
        } else {
            $front = $this->busyUnits['front'];
            $back = $updatedBusyUnitsForSide;
        }

        return new self(['front' => $front, 'back' => $back]);
    }

    /**
     * @param  array{
     *    front: array<int>,
     *    back: array<int>
     * }  $busyUnits
     * @return bool
     */
    public function validateBusyUnits(array $busyUnits): bool
    {
        $validator = Validator::make($busyUnits, [
            'front' => ['present', 'array'],
            'front.*' => ['nullable', 'numeric', 'distinct', 'min:1'],
            'back' => ['present', 'array'],
            'back.*' => ['nullable', 'numeric', 'distinct', 'min:1'],
        ]);
        if ($validator->fails()) {
            return false;
        }

        return true;
    }

    /**
     * @param  RackBusyUnitsValueObject  $busyUnitsObject
     * @return bool
     */
    public function equalTo(RackBusyUnitsValueObject $busyUnitsObject): bool
    {
        return $this->busyUnits === $busyUnitsObject->toArray();
    }
}
