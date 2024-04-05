<?php

namespace Tests\Unit\Models\ValueObjects;

use App\Models\Room;
use App\Models\ValueObjects\RoomAttributesValueObject;
use Tests\TestCase;

class RoomAttributesValueObjectTest extends TestCase
{
    public function testSetName(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getName')
            ->willReturn('some name');

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setName();
        $this->assertEquals(
            ['name' => 'some name'],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getName')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setName();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetBuildingFloor(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getBuildingFloor')
            ->willReturn('1st');

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setBuildingFloor();
        $this->assertEquals(
            ['building_floor' => '1st'],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getBuildingFloor')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setBuildingFloor();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetBuildingId(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getBuildingId')
            ->willReturn(5);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setBuildingId();
        $this->assertEquals(
            ['building_id' => 5],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getBuildingId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setBuildingId();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetNumberOfRackSpaces(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getNumberOfRackSpaces')
            ->willReturn(5);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setNumberOfRackSpaces();
        $this->assertEquals(
            ['number_of_rack_spaces' => 5],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getNumberOfRackSpaces')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setNumberOfRackSpaces();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetArea(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getArea')
            ->willReturn(50);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setArea();
        $this->assertEquals(
            ['area' => 50],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getArea')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setArea();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetCoolingSystem(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getCoolingSystem')
            ->willReturn('None');

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setCoolingSystem();
        $this->assertEquals(
            ['cooling_system' => 'None'],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getCoolingSystem')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setCoolingSystem();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetFireSuppressionSystem(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getFireSuppressionSystem')
            ->willReturn('None');

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setFireSuppressionSystem();
        $this->assertEquals(
            ['fire_suppression_system' => 'None'],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getFireSuppressionSystem')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setFireSuppressionSystem();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetAccessIsOpen(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getAccessIsOpen')
            ->willReturn(true);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setAccessIsOpen();
        $this->assertEquals(
            ['access_is_open' => true],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getAccessIsOpen')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setAccessIsOpen();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetHasRaisedFloor(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getHasRaisedFloor')
            ->willReturn(true);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setHasRaisedFloor();
        $this->assertEquals(
            ['has_raised_floor' => true],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getHasRaisedFloor')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setHasRaisedFloor();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetResponsible(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getResponsible')
            ->willReturn('responsible');

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setResponsible();
        $this->assertEquals(
            ['responsible' => 'responsible'],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getResponsible')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setResponsible();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetUpdatedBy(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn('user');

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setUpdatedBy();
        $this->assertEquals(
            ['updated_by' => 'user'],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setUpdatedBy();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetDescription(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getDescription')
            ->willReturn('description');

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setDescription();
        $this->assertEquals(
            ['description' => 'description'],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getDescription')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setDescription();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testSetDepartmentId(): void
    {
        // Attr not null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(8);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setDepartmentId();
        $this->assertEquals(
            ['department_id' => 8],
            $attributesForRoomProp->getValue($attrsMock)
        );

        // Attr is null
        $roomMock = $this->createMock(Room::class);
        $roomMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');
        $roomProp = $reflection->getProperty('room');
        $roomProp->setValue($attrsMock, $roomMock);

        $attrsMock->setDepartmentId();
        $this->assertEquals(
            [],
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testToArray(): void
    {
        $attrsMock = $this->getMockBuilder(RoomAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RoomAttributesValueObject::class);
        $attributesForRoomProp = $reflection->getProperty('attributesForRoom');

        $attributesForRoomProp->setValue($attrsMock, ['oops' => 'oops']);
        $this->assertEquals(
            $attrsMock->toArray(),
            $attributesForRoomProp->getValue($attrsMock)
        );
    }

    public function testConstructor()
    {
        $room = new Room([
            'name' => 'name',
            'building_floor' => '1st',
            'description' => 'description',
            'number_of_rack_spaces' => 4,
            'area' => 30,
            'cooling_system' => 'None',
            'fire_suppression_system' => 'None',
            'access_is_open' => true,
            'has_raised_floor' => false,
            'responsible' => 'responsible',
            'updated_by' => 'user',
            'building_id' => 2,
            'department_id' => 1,
        ]);
        $roomAttrsValueObj = new RoomAttributesValueObject($room);
        $this->assertEquals(
            [
                'name' => 'name',
                'building_floor' => '1st',
                'description' => 'description',
                'number_of_rack_spaces' => 4,
                'area' => 30,
                'cooling_system' => 'None',
                'fire_suppression_system' => 'None',
                'access_is_open' => true,
                'has_raised_floor' => false,
                'responsible' => 'responsible',
                'updated_by' => 'user',
                'building_id' => 2,
                'department_id' => 1,
            ],
            $roomAttrsValueObj->toArray()
        );

        $room = new Room([
            'name' => 'name',
            'building_floor' => '1st',
            'description' => 'description',
            'number_of_rack_spaces' => 4,
            'area' => 30,
            'cooling_system' => null,
            'fire_suppression_system' => 'None',
            'access_is_open' => true,
            'has_raised_floor' => null,
            'responsible' => 'responsible',
            'updated_by' => 'user',
            'building_id' => 2,
            'department_id' => 1,
        ]);
        $roomAttrsValueObj = new RoomAttributesValueObject($room);
        $this->assertEquals(
            [
                'name' => 'name',
                'building_floor' => '1st',
                'description' => 'description',
                'number_of_rack_spaces' => 4,
                'area' => 30,
                'fire_suppression_system' => 'None',
                'access_is_open' => true,
                'responsible' => 'responsible',
                'updated_by' => 'user',
                'building_id' => 2,
                'department_id' => 1,
            ],
            $roomAttrsValueObj->toArray()
        );
    }
}
