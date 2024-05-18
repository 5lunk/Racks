<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Room;
use App\Models\ValueObjects\RoomAttributesValueObject;
use Tests\TestCase;

class RoomTest extends TestCase
{
    public $room; // @phpstan-ignore-line

    public $attributes; // @phpstan-ignore-line

    public function setUp(): void
    {
        parent::setUp();

        $this->room = $this->getMockBuilder(Room::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(Room::class);
        $this->attributes = $reflection->getProperty('attributes');
    }

    public function testGetCreatedAt(): void
    {
        $this->attributes->setValue($this->room, ['created_at' => '2024-01-28 16:37:29']);
        $this->assertEquals(
            '2024-01-28 16:37:29',
            $this->room->getCreatedAt()
        );
    }

    public function testGetUpdatedAt(): void
    {
        $this->attributes->setValue($this->room, ['updated_at' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->room->getUpdatedAt()
        );
    }

    public function testGetUpdatedBy(): void
    {
        $this->attributes->setValue($this->room, ['updated_by' => 'tester']);
        $this->assertEquals(
            'tester',
            $this->room->getUpdatedBy()
        );

        $this->room->setUpdatedBy(null);
        $this->assertNull($this->attributes->getValue($this->room)['updated_by']);
    }

    public function testSetUpdatedBy(): void
    {
        $this->room->setUpdatedBy('user');
        $this->assertEquals(
            'user',
            $this->attributes->getValue($this->room)['updated_by']
        );

        $this->room->setUpdatedBy(null);
        $this->assertNull($this->attributes->getValue($this->room)['updated_by']);
    }

    public function testGetId(): void
    {
        $this->attributes->setValue($this->room, ['id' => 5]);
        $this->assertEquals(
            5,
            $this->room->getId()
        );
    }

    public function testSetName(): void
    {
        $this->room->setName('name');
        $this->assertEquals(
            'name',
            $this->attributes->getValue($this->room)['name']
        );

        $this->room->setName(null);
        $this->assertNull($this->attributes->getValue($this->room)['name']);
    }

    public function testGetName(): void
    {
        $this->attributes->setValue($this->room, ['name' => 'test name']);
        $this->assertEquals(
            'test name',
            $this->room->getName()
        );

        $this->room->setName(null);
        $this->assertNull($this->attributes->getValue($this->room)['name']);
    }

    public function testGetBuildingId(): void
    {
        $this->attributes->setValue($this->room, ['building_id' => 1]);
        $this->assertEquals(
            1,
            $this->room->getBuildingId()
        );

        $this->room->setBuildingId(null);
        $this->assertNull($this->attributes->getValue($this->room)['building_id']);
    }

    public function testSetBuildingId(): void
    {
        $this->room->setBuildingId(4);
        $this->assertEquals(
            4,
            $this->attributes->getValue($this->room)['building_id']
        );

        $this->room->setBuildingId(null);
        $this->assertNull($this->attributes->getValue($this->room)['building_id']);

        try {
            $this->room->setBuildingId(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$buildingId <= 0', $e->getMessage());
        }

        try {
            $this->room->setBuildingId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$buildingId <= 0', $e->getMessage());
        }
    }

    public function testGetDepartmentId(): void
    {
        $this->attributes->setValue($this->room, ['department_id' => 1]);
        $this->assertEquals(
            1,
            $this->room->getDepartmentId()
        );

        $this->room->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->room)['department_id']);
    }

    public function testSetDepartmentId(): void
    {
        $this->room->setDepartmentId(4);
        $this->assertEquals(
            4,
            $this->attributes->getValue($this->room)['department_id']
        );

        $this->room->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->room)['department_id']);

        try {
            $this->room->setDepartmentId(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }

        try {
            $this->room->setDepartmentId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }
    }

    public function testGetBuildingFloor(): void
    {
        $this->attributes->setValue($this->room, ['building_floor' => '1st']);
        $this->assertEquals(
            '1st',
            $this->room->getBuildingFloor()
        );

        $this->room->setBuildingFloor(null);
        $this->assertNull($this->attributes->getValue($this->room)['building_floor']);
    }

    public function testSetBuildingFloor(): void
    {
        $this->room->setBuildingFloor('2nd');
        $this->assertEquals(
            '2nd',
            $this->attributes->getValue($this->room)['building_floor']
        );

        $this->room->setBuildingFloor(null);
        $this->assertNull($this->attributes->getValue($this->room)['building_floor']);
    }

    public function testGetDescription(): void
    {
        $this->attributes->setValue($this->room, ['description' => 'some description']);
        $this->assertEquals(
            'some description',
            $this->room->getDescription()
        );

        $this->room->setDescription(null);
        $this->assertNull($this->attributes->getValue($this->room)['description']);
    }

    public function testSetDescription(): void
    {
        $this->room->setDescription('description');
        $this->assertEquals(
            'description',
            $this->attributes->getValue($this->room)['description']
        );

        $this->room->setDescription(null);
        $this->assertNull($this->attributes->getValue($this->room)['description']);
    }

    public function testGetNumberOfRackSpaces(): void
    {
        $this->attributes->setValue($this->room, ['number_of_rack_spaces' => 6]);
        $this->assertEquals(
            6,
            $this->room->getNumberOfRackSpaces()
        );

        $this->room->setNumberOfRackSpaces(null);
        $this->assertNull($this->attributes->getValue($this->room)['number_of_rack_spaces']);
    }

    public function testSetNumberOfRackSpaces(): void
    {
        $this->room->setNumberOfRackSpaces(7);
        $this->assertEquals(
            7,
            $this->attributes->getValue($this->room)['number_of_rack_spaces']
        );

        $this->room->setNumberOfRackSpaces(null);
        $this->assertNull($this->attributes->getValue($this->room)['number_of_rack_spaces']);

        try {
            $this->room->setNumberOfRackSpaces(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$numberOfRackSpaces <= 0', $e->getMessage());
        }

        try {
            $this->room->setNumberOfRackSpaces(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$numberOfRackSpaces <= 0', $e->getMessage());
        }
    }

    public function testGetArea(): void
    {
        $this->attributes->setValue($this->room, ['area' => 12]);
        $this->assertEquals(
            12,
            $this->room->getArea()
        );

        $this->room->setArea(null);
        $this->assertNull($this->attributes->getValue($this->room)['area']);
    }

    public function testSetArea(): void
    {
        $this->room->setArea(6);
        $this->assertEquals(
            6,
            $this->attributes->getValue($this->room)['area']
        );

        $this->room->setArea(null);
        $this->assertNull($this->attributes->getValue($this->room)['area']);

        try {
            $this->room->setArea(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$area <= 0', $e->getMessage());
        }

        try {
            $this->room->setArea(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$area <= 0', $e->getMessage());
        }
    }

    public function testGetResponsible(): void
    {
        $this->attributes->setValue($this->room, ['responsible' => 'some responsible']);
        $this->assertEquals(
            'some responsible',
            $this->room->getResponsible()
        );

        $this->room->setResponsible(null);
        $this->assertNull($this->attributes->getValue($this->room)['responsible']);
    }

    public function testSetResponsible(): void
    {
        $this->room->setResponsible('some other responsible');
        $this->assertEquals(
            'some other responsible',
            $this->attributes->getValue($this->room)['responsible']
        );

        $this->room->setResponsible(null);
        $this->assertNull($this->attributes->getValue($this->room)['responsible']);
    }

    public function testGetCoolingSystem(): void
    {
        $this->attributes->setValue($this->room, ['cooling_system' => 'Centralized']);
        $this->assertEquals(
            'Centralized',
            $this->room->getCoolingSystem()
        );

        $this->room->setCoolingSystem(null);
        $this->assertNull($this->attributes->getValue($this->room)['cooling_system']);
    }

    public function testSetCoolingSystem(): void
    {
        $this->room->setCoolingSystem('Individual');
        $this->assertEquals(
            'Individual',
            $this->attributes->getValue($this->room)['cooling_system']
        );

        $this->room->setCoolingSystem(null);
        $this->assertNull($this->attributes->getValue($this->room)['cooling_system']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$coolingSystem is not in RoomCoolingSystemEnum');
        $this->room->setCoolingSystem('Oops');
    }

    public function testGetFireSuppressionSystem(): void
    {
        $this->attributes->setValue($this->room, ['fire_suppression_system' => 'Individual']);
        $this->assertEquals(
            'Individual',
            $this->room->getFireSuppressionSystem()
        );

        $this->room->setFireSuppressionSystem(null);
        $this->assertNull($this->attributes->getValue($this->room)['fire_suppression_system']);
    }

    public function testSetFireSuppressionSystem(): void
    {
        $this->room->setFireSuppressionSystem('Alarm only');
        $this->assertEquals(
            'Alarm only',
            $this->attributes->getValue($this->room)['fire_suppression_system']
        );

        $this->room->setFireSuppressionSystem(null);
        $this->assertNull($this->attributes->getValue($this->room)['fire_suppression_system']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$fireSuppressionSystem is not in RoomFireSuppressionSystemEnum');
        $this->room->setFireSuppressionSystem('Oops');
    }

    public function testGetAccessIsOpen(): void
    {
        $this->attributes->setValue($this->room, ['access_is_open' => true]);
        $this->assertTrue($this->room->getAccessIsOpen());

        $this->attributes->setValue($this->room, ['access_is_open' => false]);
        $this->assertFalse($this->room->getAccessIsOpen());

        $this->room->setAccessIsOpen(null);
        $this->assertNull($this->attributes->getValue($this->room)['access_is_open']);
    }

    public function testSetAccessIsOpen(): void
    {
        $this->room->setAccessIsOpen(true);
        $this->assertTrue($this->attributes->getValue($this->room)['access_is_open']);

        $this->room->setAccessIsOpen(false);
        $this->assertFalse($this->attributes->getValue($this->room)['access_is_open']);

        $this->room->setAccessIsOpen(null);
        $this->assertNull($this->attributes->getValue($this->room)['access_is_open']);
    }

    public function testGetHasRaisedFloor(): void
    {
        $this->attributes->setValue($this->room, ['has_raised_floor' => true]);
        $this->assertTrue($this->room->getHasRaisedFloor());

        $this->attributes->setValue($this->room, ['has_raised_floor' => false]);
        $this->assertFalse($this->room->getHasRaisedFloor());

        $this->room->setHasRaisedFloor(null);
        $this->assertNull($this->attributes->getValue($this->room)['has_raised_floor']);
    }

    public function testSetHasRaisedFloor(): void
    {
        $this->room->setHasRaisedFloor(true);
        $this->assertTrue($this->attributes->getValue($this->room)['has_raised_floor']);

        $this->room->setHasRaisedFloor(false);
        $this->assertFalse($this->attributes->getValue($this->room)['has_raised_floor']);

        $this->room->setHasRaisedFloor(null);
        $this->assertNull($this->attributes->getValue($this->room)['has_raised_floor']);
    }

    public function testGetOldName(): void
    {
        $this->room->setOldName('test old name');
        $this->assertEquals(
            'test old name',
            $this->attributes->getValue($this->room)['old_name']
        );

        $this->room->setOldName(null);
        $this->assertNull($this->attributes->getValue($this->room)['old_name']);
    }

    public function testSetOldName(): void
    {
        $this->attributes->setValue($this->room, ['old_name' => 'other old name']);
        $this->assertEquals(
            'other old name',
            $this->room->getOldName()
        );

        $this->room->setOldName(null);
        $this->assertNull($this->attributes->getValue($this->room)['old_name']);
    }

    public function testGetAttributeSet(): void
    {
        $attrsValObjMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->app->bind(RoomAttributesValueObject::class, function () use ($attrsValObjMock) {
            return $attrsValObjMock;
        });

        $this->assertSame(
            $attrsValObjMock,
            $this->room->getAttributeSet(),
        );

        $this->app->offsetUnset(RoomAttributesValueObject::class);
    }
}
