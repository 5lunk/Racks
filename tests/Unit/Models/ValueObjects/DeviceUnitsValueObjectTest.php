<?php

declare(strict_types=1);

namespace Tests\Unit\Models\ValueObjects;

use App\Models\ValueObjects\DeviceUnitsValueObject;
use Tests\TestCase;

class DeviceUnitsValueObjectTest extends TestCase
{
    public function testConstructor(): void
    {
        $units = new DeviceUnitsValueObject(
            [3, 4, 5]
        );
        $this->assertEquals(
            [3, 4, 5],
            $units->toArray()
        );

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$units is not valid');
        $units = new DeviceUnitsValueObject(
            [12, 11, 17]
        );
    }

    public function testToArray(): void
    {
        $units = new DeviceUnitsValueObject(
            [11, 12, 13],
        );

        $this->assertEquals(
            [11, 12, 13],
            $units->toArray()
        );
    }

    public function testValidateUnits(): void
    {
        $units = new DeviceUnitsValueObject(
            [5, 6, 7]
        );

        $this->assertTrue(
            $units->validateUnits([12, 13, 14])
        );

        $this->assertFalse(
            $units->validateUnits([11, 12, 14])
        );
    }

    public function testEqualTo(): void
    {
        $units1 = new DeviceUnitsValueObject([1, 2, 3]);
        $units2 = new DeviceUnitsValueObject([1, 2, 3]);
        $units3 = new DeviceUnitsValueObject([2, 3, 4, 5]);

        $this->assertTrue($units1->equalTo($units2));
        $this->assertFalse($units1->equalTo($units3));
    }
}
