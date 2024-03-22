<?php

namespace Tests\Unit\Models;

use App\Models\Room;
use Tests\TestCase;

class RoomTest extends TestCase
{
    public $room; // Mock

    public $attributes; // Reflection property

    public function setUp(): void
    {
        $this->room = $this->getMockBuilder(Room::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(Room::class);
        $this->attributes = $reflection->getProperty('attributes');
        $this->attributes->setAccessible(true);
    }

    /*
    |--------------------------------------------------------------------------
    | Business rules
    |--------------------------------------------------------------------------
    */
    public function testIsNameValid()
    {
        $this->attributes->setValue($this->room, ['name' => 'test name']);
        $namesList1 = ['other name', 'third name', 'test name'];
        $namesList2 = ['Timmy!'];

        $this->assertFalse($this->room->isNameValid($namesList1));

        $this->assertTrue($this->room->isNameValid($namesList2));
    }

    public function testIsNameChanging()
    {
        $this->attributes->setValue($this->room, ['name' => 'test name']);

        $this->assertFalse($this->room->IsNameChanging('test name'));

        $this->assertTrue($this->room->IsNameChanging('other name'));
    }
    /*
    |--------------------------------------------------------------------------
    */

    public function testSetUpdatedBy()
    {
        $this->room->setUpdatedBy('tester');
        $this->assertEquals(
            'tester',
            $this->attributes->getValue($this->room)['updated_by']
        );

        $this->room->setUpdatedBy(null);
        $this->assertNull($this->attributes->getValue($this->room)['updated_by']);
    }

    public function testGetCreatedAt()
    {
        $this->attributes->setValue($this->room, ['created_at' => '2024-01-28 16:37:29']);
        $this->assertEquals(
            '2024-01-28 16:37:29',
            $this->room->getCreatedAt()
        );
    }

    public function testGetUpdatedAt()
    {
        $this->attributes->setValue($this->room, ['updated_at' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->room->getUpdatedAt()
        );
    }

    public function testGetUpdatedBy()
    {
        $this->attributes->setValue($this->room, ['updated_by' => 'tester']);
        $this->assertEquals(
            'tester',
            $this->room->getUpdatedBy()
        );

        $this->room->setUpdatedBy(null);
        $this->assertNull($this->attributes->getValue($this->room)['updated_by']);
    }

    public function testGetId()
    {
        $this->attributes->setValue($this->room, ['id' => 5]);
        $this->assertEquals(
            5,
            $this->room->getId()
        );
    }

    public function testSetName()
    {
        $this->room->setName('Test name');
        $this->assertEquals(
            'Test name',
            $this->attributes->getValue($this->room)['name']
        );

        $this->room->setName(null);
        $this->assertNull($this->attributes->getValue($this->room)['name']);
    }

    public function testGetName()
    {
        $this->attributes->setValue($this->room, ['name' => 'test name']);
        $this->assertEquals(
            'test name',
            $this->room->getName()
        );

        $this->room->setName(null);
        $this->assertNull($this->attributes->getValue($this->room)['name']);
    }

    public function testGetBuildingId()
    {
        $this->attributes->setValue($this->room, ['building_id' => 1]);
        $this->assertEquals(
            1,
            $this->room->getBuildingId()
        );

        $this->room->setBuildingId(null);
        $this->assertNull($this->attributes->getValue($this->room)['building_id']);
    }

    public function testSetBuildingId()
    {
        $this->room->setBuildingId(4);
        $this->assertEquals(
            4,
            $this->attributes->getValue($this->room)['building_id']
        );

        $this->room->setBuildingId(null);
        $this->assertNull($this->attributes->getValue($this->room)['building_id']);
    }

    public function testGetDepartmentId()
    {
        $this->attributes->setValue($this->room, ['department_id' => 1]);
        $this->assertEquals(
            1,
            $this->room->getDepartmentId()
        );

        $this->room->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->room)['department_id']);
    }

    public function testSetDepartmentId()
    {
        $this->room->setDepartmentId(4);
        $this->assertEquals(
            4,
            $this->attributes->getValue($this->room)['department_id']
        );

        $this->room->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->room)['department_id']);
    }

    public function testGetBuildingFloor()
    {
        $this->attributes->setValue($this->room, ['building_floor' => '1st']);
        $this->assertEquals(
            '1st',
            $this->room->getBuildingFloor()
        );

        $this->room->setBuildingFloor(null);
        $this->assertNull($this->attributes->getValue($this->room)['building_floor']);
    }

    public function testSetBuildingFloor()
    {
        $this->room->setBuildingFloor('1st');
        $this->assertEquals(
            '1st',
            $this->attributes->getValue($this->room)['building_floor']
        );

        $this->room->setBuildingFloor(null);
        $this->assertNull($this->attributes->getValue($this->room)['building_floor']);
    }

    public function testGetDescription()
    {
        $this->attributes->setValue($this->room, ['description' => 'some description']);
        $this->assertEquals(
            'some description',
            $this->room->getDescription()
        );

        $this->room->setDescription(null);
        $this->assertNull($this->attributes->getValue($this->room)['description']);
    }

    public function testSetDescription()
    {
        $this->room->setBuildingFloor('1st');
        $this->assertEquals(
            '1st',
            $this->attributes->getValue($this->room)['building_floor']
        );

        $this->room->setBuildingFloor(null);
        $this->assertNull($this->attributes->getValue($this->room)['building_floor']);
    }

    public function testGetNumberOfRackSpaces()
    {
        $this->attributes->setValue($this->room, ['number_of_rack_spaces' => 6]);
        $this->assertEquals(
            6,
            $this->room->getNumberOfRackSpaces()
        );

        $this->room->setNumberOfRackSpaces(null);
        $this->assertNull($this->attributes->getValue($this->room)['number_of_rack_spaces']);
    }

    public function testSetNumberOfRackSpaces()
    {
        $this->room->setNumberOfRackSpaces(6);
        $this->assertEquals(
            6,
            $this->attributes->getValue($this->room)['number_of_rack_spaces']
        );

        $this->room->setNumberOfRackSpaces(null);
        $this->assertNull($this->attributes->getValue($this->room)['number_of_rack_spaces']);
    }

    public function testGetArea()
    {
        $this->attributes->setValue($this->room, ['area' => 12]);
        $this->assertEquals(
            12,
            $this->room->getArea()
        );

        $this->room->setArea(null);
        $this->assertNull($this->attributes->getValue($this->room)['area']);
    }

    public function testSetArea()
    {
        $this->room->setArea(6);
        $this->assertEquals(
            6,
            $this->attributes->getValue($this->room)['area']
        );

        $this->room->setArea(null);
        $this->assertNull($this->attributes->getValue($this->room)['area']);
    }

    public function testGetResponsible()
    {
        $this->attributes->setValue($this->room, ['responsible' => 'some responsible']);
        $this->assertEquals(
            'some responsible',
            $this->room->getResponsible()
        );

        $this->room->setResponsible(null);
        $this->assertNull($this->attributes->getValue($this->room)['responsible']);
    }

    public function testSetResponsible()
    {
        $this->room->setResponsible('some responsible');
        $this->assertEquals(
            'some responsible',
            $this->attributes->getValue($this->room)['responsible']
        );

        $this->room->setResponsible(null);
        $this->assertNull($this->attributes->getValue($this->room)['responsible']);
    }

    public function testGetCoolingSystem()
    {
        $this->attributes->setValue($this->room, ['cooling_system' => 'cooling system']);
        $this->assertEquals(
            'cooling system',
            $this->room->getCoolingSystem()
        );

        $this->room->setCoolingSystem(null);
        $this->assertNull($this->attributes->getValue($this->room)['cooling_system']);
    }

    public function testSetCoolingSystem()
    {
        $this->room->setCoolingSystem('cooling system');
        $this->assertEquals(
            'cooling system',
            $this->attributes->getValue($this->room)['cooling_system']
        );

        $this->room->setCoolingSystem(null);
        $this->assertNull($this->attributes->getValue($this->room)['cooling_system']);
    }

    public function testGetFireSuppressionSystem()
    {
        $this->attributes->setValue($this->room, ['fire_suppression_system' => 'fire suppression system']);
        $this->assertEquals(
            'fire suppression system',
            $this->room->getFireSuppressionSystem()
        );

        $this->room->setFireSuppressionSystem(null);
        $this->assertNull($this->attributes->getValue($this->room)['fire_suppression_system']);
    }

    public function testSetFireSuppressionSystem()
    {
        $this->room->setFireSuppressionSystem('fire suppression system');
        $this->assertEquals(
            'fire suppression system',
            $this->attributes->getValue($this->room)['fire_suppression_system']
        );

        $this->room->setFireSuppressionSystem(null);
        $this->assertNull($this->attributes->getValue($this->room)['fire_suppression_system']);
    }

    public function testGetAccessIsOpen()
    {
        $this->attributes->setValue($this->room, ['access_is_open' => true]);
        $this->assertEquals(
            true,
            $this->room->getAccessIsOpen()
        );

        $this->attributes->setValue($this->room, ['access_is_open' => false]);
        $this->assertEquals(
            false,
            $this->room->getAccessIsOpen()
        );

        $this->room->setAccessIsOpen(null);
        $this->assertNull($this->attributes->getValue($this->room)['access_is_open']);
    }

    public function testSetAccessIsOpen()
    {
        $this->room->setAccessIsOpen(true);
        $this->assertEquals(
            true,
            $this->attributes->getValue($this->room)['access_is_open']
        );

        $this->room->setAccessIsOpen(false);
        $this->assertEquals(
            false,
            $this->attributes->getValue($this->room)['access_is_open']
        );

        $this->room->setAccessIsOpen(null);
        $this->assertNull($this->attributes->getValue($this->room)['access_is_open']);
    }

    public function testGetHasRaisedFloor()
    {
        $this->attributes->setValue($this->room, ['has_raised_floor' => true]);
        $this->assertEquals(
            true,
            $this->room->getHasRaisedFloor()
        );

        $this->attributes->setValue($this->room, ['has_raised_floor' => false]);
        $this->assertEquals(
            false,
            $this->room->getHasRaisedFloor()
        );

        $this->room->setHasRaisedFloor(null);
        $this->assertNull($this->attributes->getValue($this->room)['has_raised_floor']);
    }

    public function testSetHasRaisedFloor()
    {
        $this->room->setHasRaisedFloor(true);
        $this->assertEquals(
            true,
            $this->attributes->getValue($this->room)['has_raised_floor']
        );

        $this->room->setHasRaisedFloor(false);
        $this->assertEquals(
            false,
            $this->attributes->getValue($this->room)['has_raised_floor']
        );

        $this->room->setHasRaisedFloor(null);
        $this->assertNull($this->attributes->getValue($this->room)['has_raised_floor']);
    }

    public function testGetOldName()
    {
        $this->room->setOldName('test old name');
        $this->assertEquals(
            'test old name',
            $this->attributes->getValue($this->room)['old_name']
        );

        $this->room->setOldName(null);
        $this->assertNull($this->attributes->getValue($this->room)['old_name']);
    }

    public function testSetOldName()
    {
        $this->attributes->setValue($this->room, ['old_name' => 'test old name']);
        $this->assertEquals(
            'test old name',
            $this->room->getOldName()
        );

        $this->room->setOldName(null);
        $this->assertNull($this->attributes->getValue($this->room)['old_name']);
    }
}
