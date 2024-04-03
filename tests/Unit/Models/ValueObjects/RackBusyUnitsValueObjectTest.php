<?php

namespace Tests\Unit\Models\ValueObjects;

use App\Models\ValueObjects\RackBusyUnitsValueObject;
use Tests\TestCase;

class RackBusyUnitsValueObjectTest extends TestCase
{
    public function testConstructor(): void
    {
        $busyUnits = new RackBusyUnitsValueObject(
            ['front' => [3, 5, 4], 'back' => [12, 13, 11]]
        );
        $this->assertEquals(
            ['front' => [3, 4, 5], 'back' => [11, 12, 13]],
            $busyUnits->toArray()
        );

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$busyUnits is not valid');
        $busyUnits = new RackBusyUnitsValueObject(
            ['back' => [12, 13, 11]]
        );
    }

    public function testGetUnitsForSide(): void
    {
        $busyUnits = new RackBusyUnitsValueObject(
            ['front' => [3, 4, 5], 'back' => [11, 12, 13]],
        );

        $this->assertEquals(
            [11, 12, 13],
            $busyUnits->getUnitsForSide(true)
        );

        $this->assertEquals(
            [3, 4, 5],
            $busyUnits->getUnitsForSide(false)
        );
    }

    public function testUpdateBusyUnits(): void
    {
        $busyUnits = new RackBusyUnitsValueObject(
            ['front' => [3, 4, 5], 'back' => [11, 12, 13]],
        );

        $busyUnits->updateBusyUnits([7, 8], false);
        $this->assertEquals(
            (new RackBusyUnitsValueObject(
                ['front' => [7, 8], 'back' => [11, 12, 13]],
            ))->toArray(),
            $busyUnits->toArray()
        );

        $busyUnits->updateBusyUnits([4, 8], true);
        $this->assertEquals(
            (new RackBusyUnitsValueObject(
                ['front' => [7, 8], 'back' => [4, 8]],
            ))->toArray(),
            $busyUnits->toArray()
        );
    }

    public function testValidateBusyUnits(): void
    {
        $busyUnits = new RackBusyUnitsValueObject(
            ['front' => [3, 4, 5], 'back' => [11, 12, 13]],
        );

        $this->assertTrue(
            $busyUnits->validateBusyUnits(['front' => [3, 4, 5], 'back' => [11, 12, 13]])
        );

        $this->assertTrue(
            $busyUnits->validateBusyUnits(['front' => [], 'back' => []])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['front' => '[3, 4, 5]', 'back' => [11, 12, 13]])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['back' => [11, 12, 13]])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['front' => [3, 4, 5]])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['front' => ['a', 4, 5]])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['front' => [4, 4, 5]])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['front' => [3, 4, 5], 'back' => '[11, 12, 13]'])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['back' => [11, 12, 13]])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['back' => [3, 4, 5]])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['back' => ['a', 4, 5]])
        );

        $this->assertFalse(
            $busyUnits->validateBusyUnits(['back' => [4, 4, 5]])
        );
    }

    public function testToArray(): void
    {
        $busyUnits = new RackBusyUnitsValueObject(
            ['front' => [3, 4, 5], 'back' => [11, 12, 13]],
        );

        $this->assertEquals(
            ['front' => [3, 4, 5], 'back' => [11, 12, 13]],
            $busyUnits->toArray()
        );
    }
}
