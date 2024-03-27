<?php

namespace Tests\Unit\Models;

use App\Domain\Interfaces\DeviceInterfaces\DeviceEntity;
use App\Models\Rack;
use App\Models\ValueObjects\DeviceUnitsValueObject;
use App\Models\ValueObjects\RackBusyUnitsValueObject;
use Tests\TestCase;

class RackTest extends TestCase
{
    public $rack; // Mock

    public $attributes; // Reflection property

    public function setUp(): void
    {
        parent::setUp();

        // Mock for Getters and Setters
        $this->rack = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(Rack::class);
        $this->attributes = $reflection->getProperty('attributes');
        $this->attributes->setAccessible(true);
    }

    /*
    |--------------------------------------------------------------------------
    | Business rules
    |--------------------------------------------------------------------------
    */

    public function testAddNewBusyUnits()
    {
        // Front side use-case
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([1, 2, 3]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->exactly(3))
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->exactly(2))
            ->method('getLocation')
            ->willReturn(false);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(false)
            ->willReturn([7, 8, 9, 10]);

        $busyUnitsMock->expects($this->once())
            ->method('updateBusyUnits')
            ->with([7, 8, 9, 10, 1, 2, 3])
            ->willReturn($busyUnitsMock);

        $this->assertSame(
            $busyUnitsMock,
            $rackMock->addNewBusyUnits($deviceMock)
        );

        // Back side use-case
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([2, 3, 4]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->exactly(3))
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->exactly(2))
            ->method('getLocation')
            ->willReturn(true);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(true)
            ->willReturn([8, 9, 10, 11]);

        $busyUnitsMock->expects($this->once())
            ->method('updateBusyUnits')
            ->with([8, 9, 10, 11, 2, 3, 4])
            ->willReturn($busyUnitsMock);

        $this->assertSame(
            $busyUnitsMock,
            $rackMock->addNewBusyUnits($deviceMock)
        );

    }

    public function testDeleteOldBusyUnits()
    {
        // Front side use-case
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([11, 12]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->exactly(3))
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->exactly(2))
            ->method('getLocation')
            ->willReturn(false);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(false)
            ->willReturn([7, 8, 9, 10, 11, 12]);

        $busyUnitsMock->expects($this->once())
            ->method('updateBusyUnits')
            ->with([7, 8, 9, 10])
            ->willReturn($busyUnitsMock);

        $this->assertSame(
            $busyUnitsMock,
            $rackMock->deleteOldBusyUnits($deviceMock)
        );

        // Back side use-case
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([13, 14]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->exactly(3))
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->exactly(2))
            ->method('getLocation')
            ->willReturn(true);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(true)
            ->willReturn([10, 11, 12, 13, 14, 15]);

        $busyUnitsMock->expects($this->once())
            ->method('updateBusyUnits')
            ->with([10, 11, 12, 5 => 15])
            ->willReturn($busyUnitsMock);

        $this->assertSame(
            $busyUnitsMock,
            $rackMock->deleteOldBusyUnits($deviceMock)
        );
    }

    public function testIsDeviceAddable()
    {
        // Front side device addable
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([1, 2, 3]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->once())
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(false);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(false)
            ->willReturn([7, 8, 9, 10]);

        $this->assertTrue(
            $rackMock->isDeviceAddable($deviceMock)
        );

        // Front side device not addable
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([1, 2, 3]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->once())
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(false);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(false)
            ->willReturn([1, 7, 8, 9, 10]);

        $this->assertFalse(
            $rackMock->isDeviceAddable($deviceMock)
        );

        // Back side device addable
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([22, 23]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->once())
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(true);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(true)
            ->willReturn([17, 18, 19, 21]);

        $this->assertTrue(
            $rackMock->isDeviceAddable($deviceMock)
        );

        // Back side device not addable
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([20, 21]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->once())
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(true);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(true)
            ->willReturn([17, 18, 19, 21]);

        $this->assertFalse(
            $rackMock->isDeviceAddable($deviceMock)
        );
    }

    public function testHasDeviceUnits()
    {
        // Full units intersection
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([4, 5, 6]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getAmount'])
            ->getMock();

        $rackMock->expects($this->once())
            ->method('getAmount')
            ->willReturn(20);

        $this->assertTrue(
            $rackMock->hasDeviceUnits($deviceMock)
        );

        // Partial units intersection
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([20, 21, 22]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getAmount'])
            ->getMock();

        $rackMock->expects($this->once())
            ->method('getAmount')
            ->willReturn(20);

        $this->assertFalse(
            $rackMock->hasDeviceUnits($deviceMock)
        );

        // 0 units intersection
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([25, 26]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getAmount'])
            ->getMock();

        $rackMock->expects($this->once())
            ->method('getAmount')
            ->willReturn(20);

        $this->assertFalse(
            $rackMock->hasDeviceUnits($deviceMock)
        );
    }

    public function testIsDeviceMovingValid()
    {
        // Valid without moving intersection
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([4, 5]));

        $deviceUpdatingMock = $this->createMock(DeviceEntity::class);

        $deviceUpdatingMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([6, 7]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->once())
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(true);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(true)
            ->willReturn([1, 2, 3, 17, 18, 19, 21]);

        $this->assertTrue(
            $rackMock->isDeviceMovingValid($deviceMock, $deviceUpdatingMock)
        );

        // Valid with moving intersection
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([4, 5, 6]));

        $deviceUpdatingMock = $this->createMock(DeviceEntity::class);

        $deviceUpdatingMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([5, 6, 7]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->once())
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(true);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(true)
            ->willReturn([1, 2, 3, 17, 18, 19, 21]);

        $this->assertTrue(
            $rackMock->isDeviceMovingValid($deviceMock, $deviceUpdatingMock)
        );

        // Not valid
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([4, 5, 6]));

        $deviceUpdatingMock = $this->createMock(DeviceEntity::class);

        $deviceUpdatingMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([5, 6, 7]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->once())
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(true);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(true)
            ->willReturn([1, 2, 3, 7, 8, 9, 17, 18, 19, 21]);

        $this->assertFalse(
            $rackMock->isDeviceMovingValid($deviceMock, $deviceUpdatingMock)
        );

        // Not valid, full intersection with busy units
        $deviceMock = $this->createMock(DeviceEntity::class);

        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([4, 5, 6]));

        $deviceUpdatingMock = $this->createMock(DeviceEntity::class);

        $deviceUpdatingMock->expects($this->once())
            ->method('getUnits')
            ->willReturn(new DeviceUnitsValueObject([17, 18, 19]));

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getBusyUnits'])
            ->getMock();

        $busyUnitsMock = $this->createMock(RackBusyUnitsValueObject::class);

        $rackMock->expects($this->once())
            ->method('getBusyUnits')
            ->willReturn($busyUnitsMock);

        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(true);

        $busyUnitsMock->expects($this->once())
            ->method('getUnitsForSide')
            ->with(true)
            ->willReturn([1, 2, 3, 7, 8, 9, 17, 18, 19, 21]);

        $this->assertFalse(
            $rackMock->isDeviceMovingValid($deviceMock, $deviceUpdatingMock)
        );
    }

    public function testIsNameValid()
    {
        // Not valid (not unique)
        $namesList1 = ['other name', 'third name', 'test name'];

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getName'])
            ->getMock();

        $rackMock->expects($this->once())
            ->method('getName')
            ->willReturn('test name');

        $this->assertFalse(
            $rackMock->isNameValid($namesList1)
        );

        // Valid
        $namesList2 = ['Timmy!'];

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getName'])
            ->getMock();

        $rackMock->expects($this->once())
            ->method('getName')
            ->willReturn('test name');

        $this->assertTrue(
            $rackMock->isNameValid($namesList2)
        );
    }

    public function testIsNameChanging()
    {
        // Changing
        $newName1 = 'test name';

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getName'])
            ->getMock();

        $rackMock->expects($this->once())
            ->method('getName')
            ->willReturn('not test name');

        $this->assertTrue(
            $rackMock->isNameChanging($newName1)
        );

        // Not changing
        $newName2 = 'Timmy!';

        $rackMock = $this->getMockBuilder(Rack::class)
            ->onlyMethods(['getName'])
            ->getMock();

        $rackMock->expects($this->once())
            ->method('getName')
            ->willReturn('Timmy!');

        $this->assertFalse(
            $rackMock->isNameChanging($newName2)
        );
    }
    /*
    |--------------------------------------------------------------------------
    */

    public function testGetBusyUnits()
    {
        // $busyUnits is an array
        $this->attributes->setValue(
            $this->rack, ['busy_units' => ['front' => [1, 2, 3], 'back' => [3, 4, 5, 6]]]
        );
        $this->assertEquals(
            ['front' => [1, 2, 3], 'back' => [3, 4, 5, 6]],
            $this->rack->getBusyUnits()->toArray(),
        );

        // $busyUnits is string
        $this->attributes->setValue(
            $this->rack, ['busy_units' => '{"front": [1, 2], "back": [3, 4, 5, 6]}']
        );
        $this->assertEquals(
            ['front' => [1, 2], 'back' => [3, 4, 5, 6]],
            $this->rack->getBusyUnits()->toArray(),
        );

        // Testing injected RackBusyUnitsValueObject via app()->make()
        $this->attributes->setValue(
            $this->rack, ['busy_units' => '{"front": [], "back": []}']
        );

        $busyUnitsMock = $this->getMockBuilder(RackBusyUnitsValueObject::class)
            ->onlyMethods(['toArray'])
            ->setConstructorArgs([['front' => [1, 2, 3], 'back' => [3, 4, 5]]])
            ->getMock();

        $busyUnitsMock->method('toArray')
            ->willReturn(['front' => [1, 2, 3], 'back' => [3, 4, 5]]);

        $this->app->bind(RackBusyUnitsValueObject::class, function () use ($busyUnitsMock) {
            return $busyUnitsMock;
        });

        $this->assertSame(
            ['front' => [1, 2, 3], 'back' => [3, 4, 5]],
            $this->rack->getBusyUnits()->toArray(),
        );

        // Unbind mock
        $this->app->offsetUnset(RackBusyUnitsValueObject::class);

        // $busyUnits is RackBusyUnitsValueObject
        $this->attributes->setValue(
            $this->rack, ['busy_units' => $busyUnitsMock]
        );
        $this->assertSame(
            ['front' => [1, 2, 3], 'back' => [3, 4, 5]],
            $this->rack->getBusyUnits()->toArray(),
        );

        // $busyUnits is not JSONable
        $this->attributes->setValue(
            $this->rack, ['busy_units' => 'fytnfgsfghsfghfhgb']
        );
        try {
            $this->rack->getBusyUnits();
        } catch (\DomainException $e) {
            $this->assertEquals('$busyUnits json decode failed', $e->getMessage());
        }

        // Main throw
        $this->attributes->setValue(
            $this->rack, ['busy_units' => 1234]
        );
        try {
            $this->rack->getBusyUnits();
        } catch (\DomainException $e) {
            $this->assertEquals('$busyUnits dont match any allowed type', $e->getMessage());
        }
    }

    public function testSetBusyUnits()
    {
        $this->attributes->setValue(
            $this->rack, ['busy_units' => '{"front": [], "back": []}']
        );
        $busyUnitsMock = $this->getMockBuilder(RackBusyUnitsValueObject::class)
            ->onlyMethods(['toArray'])
            ->setConstructorArgs([['front' => [1, 2, 3], 'back' => [3, 4, 5]]])
            ->getMock();
        $busyUnitsMock->method('toArray')
            ->willReturn(['front' => [1, 2, 3], 'back' => [3, 4, 5]]);

        $this->rack->setBusyUnits($busyUnitsMock);
        $this->assertEquals(
            $busyUnitsMock->toArray(),
            $this->attributes->getValue($this->rack)['busy_units']->toArray()
        );
    }

    public function testSetUpdatedBy()
    {
        $this->rack->setUpdatedBy('tester');
        $this->assertEquals(
            'tester',
            $this->attributes->getValue($this->rack)['updated_by']
        );

        $this->rack->setUpdatedBy(null);
        $this->assertNull($this->attributes->getValue($this->rack)['updated_by']);
    }

    public function testSetInventoryNumber()
    {
        $this->rack->setInventoryNumber('df6876876');
        $this->assertEquals(
            'df6876876',
            $this->attributes->getValue($this->rack)['inventory_number']
        );

        $this->rack->setInventoryNumber(null);
        $this->assertNull($this->attributes->getValue($this->rack)['inventory_number']);
    }

    public function testSetPowerSockets()
    {
        $this->rack->setPowerSockets(10);
        $this->assertEquals(
            10,
            $this->attributes->getValue($this->rack)['power_sockets']
        );

        $this->rack->setPowerSockets(null);
        $this->assertNull($this->attributes->getValue($this->rack)['power_sockets']);

        try {
            $this->rack->setPowerSockets(-10);
        } catch (\DomainException $e) {
            $this->assertEquals('$powerSockets <= 0', $e->getMessage());
        }

        try {
            $this->rack->setPowerSockets(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$powerSockets <= 0', $e->getMessage());
        }
    }

    public function testGetLinkToDocs()
    {
        $this->attributes->setValue($this->rack, ['link_to_docs' => 'link']);
        $this->assertEquals(
            'link',
            $this->rack->getLinkToDocs()
        );

        $this->attributes->setValue($this->rack, ['link_to_docs' => null]);
        $this->assertNull($this->rack->getLinkToDocs());
    }

    public function testGetHeight()
    {
        $this->attributes->setValue($this->rack, ['height' => 12]);
        $this->assertEquals(
            12,
            $this->rack->getHeight()
        );

        $this->attributes->setValue($this->rack, ['height' => null]);
        $this->assertNull($this->rack->getHeight());
    }

    public function testGetHasExternalUps()
    {
        $this->attributes->setValue($this->rack, ['has_external_ups' => true]);
        $this->assertTrue($this->rack->getHasExternalUps());

        $this->attributes->setValue($this->rack, ['has_external_ups' => false]);
        $this->assertFalse($this->rack->getHasExternalUps());

        $this->attributes->setValue($this->rack, ['has_external_ups' => null]);
        $this->assertNull($this->rack->getHasExternalUps());
    }

    public function testGetMaxLoad()
    {
        $this->attributes->setValue($this->rack, ['max_load' => 1000]);
        $this->assertEquals(
            1000,
            $this->rack->getMaxLoad()
        );

        $this->attributes->setValue($this->rack, ['max_load' => null]);
        $this->assertNull($this->rack->getMaxLoad());
    }

    public function testSetDescription()
    {
        $this->rack->setDescription('some description');
        $this->assertEquals(
            'some description',
            $this->attributes->getValue($this->rack)['description']
        );

        $this->rack->setDescription(null);
        $this->assertNull($this->attributes->getValue($this->rack)['description']);
    }

    public function testGetModel()
    {
        $this->attributes->setValue($this->rack, ['model' => 'some model']);
        $this->assertEquals(
            'some model',
            $this->rack->getModel()
        );

        $this->attributes->setValue($this->rack, ['model' => null]);
        $this->assertNull($this->rack->getModel());
    }

    public function testSetUnitWidth()
    {
        $this->rack->setUnitWidth(300);
        $this->assertEquals(
            300,
            $this->attributes->getValue($this->rack)['unit_width']
        );

        $this->rack->setUnitWidth(null);
        $this->assertNull($this->attributes->getValue($this->rack)['unit_width']);

        try {
            $this->rack->setUnitWidth(-10);
        } catch (\DomainException $e) {
            $this->assertEquals('$unitWidth <= 0', $e->getMessage());
        }

        try {
            $this->rack->setUnitWidth(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$unitWidth <= 0', $e->getMessage());
        }
    }

    public function testGetUnitWidth()
    {
        $this->attributes->setValue($this->rack, ['unit_width' => 300]);
        $this->assertEquals(
            300,
            $this->rack->getUnitWidth()
        );

        $this->attributes->setValue($this->rack, ['unit_width' => null]);
        $this->assertNull($this->rack->getUnitWidth());
    }

    public function testGetOldName()
    {
        $this->attributes->setValue($this->rack, ['old_name' => 'Old name']);
        $this->assertEquals(
            'Old name',
            $this->rack->getOldName()
        );

        $this->attributes->setValue($this->rack, ['old_name' => null]);
        $this->assertNull($this->rack->getOldName());
    }

    public function testSetVendor()
    {
        $this->rack->setVendor('Some vendor');
        $this->assertEquals(
            'Some vendor',
            $this->attributes->getValue($this->rack)['vendor']
        );

        $this->rack->setVendor(null);
        $this->assertNull($this->attributes->getValue($this->rack)['vendor']);
    }

    public function testSetDepth()
    {
        $this->rack->setDepth(300);
        $this->assertEquals(
            300,
            $this->attributes->getValue($this->rack)['depth']
        );

        $this->rack->setDepth(null);
        $this->assertNull($this->attributes->getValue($this->rack)['depth']);

        try {
            $this->rack->setDepth(-10);
        } catch (\DomainException $e) {
            $this->assertEquals('$depth <= 0', $e->getMessage());
        }

        try {
            $this->rack->setDepth(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$depth <= 0', $e->getMessage());
        }
    }

    public function testGetPlaceType()
    {
        $this->attributes->setValue($this->rack, ['place_type' => 'Floor standing']);
        $this->assertEquals(
            'Floor standing',
            $this->rack->getPlaceType()
        );

        $this->attributes->setValue($this->rack, ['place_type' => null]);
        $this->assertNull($this->rack->getPlaceType());
    }

    public function testGetPowerSocketsUps()
    {
        $this->attributes->setValue($this->rack, ['power_sockets_ups' => 5]);
        $this->assertEquals(
            5,
            $this->rack->getPowerSocketsUps()
        );

        $this->attributes->setValue($this->rack, ['power_sockets_ups' => null]);
        $this->assertNull($this->rack->getPowerSocketsUps());
    }

    public function testGetAmount()
    {
        $this->attributes->setValue($this->rack, ['amount' => 40]);
        $this->assertEquals(
            40,
            $this->rack->getAmount()
        );

        $this->attributes->setValue($this->rack, ['amount' => null]);
        $this->assertNull($this->rack->getAmount());
    }

    public function testGetPlace()
    {
        $this->attributes->setValue($this->rack, ['place' => 'Some place']);
        $this->assertEquals(
            'Some place',
            $this->rack->getPlace()
        );

        $this->attributes->setValue($this->rack, ['place' => null]);
        $this->assertNull($this->rack->getPlace());
    }

    public function testSetModel()
    {
        $this->rack->setModel('Some model');
        $this->assertEquals(
            'Some model',
            $this->attributes->getValue($this->rack)['model']
        );

        $this->rack->setModel(null);
        $this->assertNull($this->attributes->getValue($this->rack)['model']);
    }

    public function testGetType()
    {
        $this->attributes->setValue($this->rack, ['type' => 'Rack']);
        $this->assertEquals(
            'Rack',
            $this->rack->getType()
        );

        $this->attributes->setValue($this->rack, ['type' => null]);
        $this->assertNull($this->rack->getType());
    }

    public function testGetCreatedAt()
    {
        $this->attributes->setValue($this->rack, ['created_at' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->rack->getCreatedAt()
        );
    }

    public function testGetResponsible()
    {
        $this->attributes->setValue($this->rack, ['responsible' => 'Some responsible']);
        $this->assertEquals(
            'Some responsible',
            $this->rack->getResponsible()
        );

        $this->attributes->setValue($this->rack, ['responsible' => null]);
        $this->assertNull($this->rack->getResponsible());
    }

    public function testGetUnitDepth()
    {
        $this->attributes->setValue($this->rack, ['unit_depth' => 300]);
        $this->assertEquals(
            300,
            $this->rack->getUnitDepth()
        );

        $this->attributes->setValue($this->rack, ['unit_depth' => null]);
        $this->assertNull($this->rack->getUnitDepth());
    }

    public function testSetRoomId()
    {
        $this->rack->setRoomId(2);
        $this->assertEquals(
            2,
            $this->attributes->getValue($this->rack)['room_id']
        );

        $this->rack->setRoomId(null);
        $this->assertNull($this->attributes->getValue($this->rack)['room_id']);

        try {
            $this->rack->setRoomId(-10);
        } catch (\DomainException $e) {
            $this->assertEquals('$roomId <= 0', $e->getMessage());
        }

        try {
            $this->rack->setRoomId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$roomId <= 0', $e->getMessage());
        }
    }

    public function testSetMaxLoad()
    {
        $this->rack->setMaxLoad(200);
        $this->assertEquals(
            200,
            $this->attributes->getValue($this->rack)['max_load']
        );

        $this->rack->setMaxLoad(null);
        $this->assertNull($this->attributes->getValue($this->rack)['max_load']);

        try {
            $this->rack->setMaxLoad(-10);
        } catch (\DomainException $e) {
            $this->assertEquals('$maxLoad <= 0', $e->getMessage());
        }

        try {
            $this->rack->setMaxLoad(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$maxLoad <= 0', $e->getMessage());
        }
    }

    public function testSetHeight()
    {
        $this->rack->setHeight(2000);
        $this->assertEquals(
            2000,
            $this->attributes->getValue($this->rack)['height']
        );

        $this->rack->setHeight(null);
        $this->assertNull($this->attributes->getValue($this->rack)['height']);

        try {
            $this->rack->setHeight(-6);
        } catch (\DomainException $e) {
            $this->assertEquals('$height <= 0', $e->getMessage());
        }

        try {
            $this->rack->setHeight(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$height <= 0', $e->getMessage());
        }
    }

    public function testSetUnitDepth()
    {
        $this->rack->setUnitDepth(200);
        $this->assertEquals(
            200,
            $this->attributes->getValue($this->rack)['unit_depth']
        );

        $this->rack->setUnitDepth(null);
        $this->assertNull($this->attributes->getValue($this->rack)['unit_depth']);

        try {
            $this->rack->setUnitDepth(-10);
        } catch (\DomainException $e) {
            $this->assertEquals('$unitDepth <= 0', $e->getMessage());
        }

        try {
            $this->rack->setUnitDepth(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$unitDepth <= 0', $e->getMessage());
        }
    }

    public function testGetPowerSockets()
    {
        $this->attributes->setValue($this->rack, ['power_sockets' => 20]);
        $this->assertEquals(
            20,
            $this->rack->getPowerSockets()
        );

        $this->attributes->setValue($this->rack, ['power_sockets' => null]);
        $this->assertNull($this->rack->getPowerSockets());
    }

    public function testSetType()
    {
        $this->rack->setType('Rack');
        $this->assertEquals(
            'Rack',
            $this->attributes->getValue($this->rack)['type']
        );

        $this->rack->setType(null);
        $this->assertNull($this->attributes->getValue($this->rack)['type']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$type is not in RackTypeEnum');
        $this->rack->setType('Oops');
    }

    public function testGetFinanciallyResponsiblePerson()
    {
        $this->attributes->setValue($this->rack, ['financially_responsible_person' => 'Some person']);
        $this->assertEquals(
            'Some person',
            $this->rack->getFinanciallyResponsiblePerson()
        );

        $this->attributes->setValue($this->rack, ['financially_responsible_person' => null]);
        $this->assertNull($this->rack->getFinanciallyResponsiblePerson());
    }

    public function testGetId()
    {
        $this->attributes->setValue($this->rack, ['id' => 3]);
        $this->assertEquals(
            3,
            $this->rack->getId()
        );
    }

    public function testSetPlace()
    {
        $this->rack->setPlace('Some place');
        $this->assertEquals(
            'Some place',
            $this->attributes->getValue($this->rack)['place']
        );

        $this->rack->setPlace(null);
        $this->assertNull($this->attributes->getValue($this->rack)['place']);
    }

    public function testSetDepartmentId()
    {
        $this->rack->setDepartmentId(2);
        $this->assertEquals(
            2,
            $this->attributes->getValue($this->rack)['department_id']
        );

        $this->rack->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->rack)['department_id']);

        try {
            $this->rack->setDepartmentId(-10);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }

        try {
            $this->rack->setDepartmentId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }
    }

    public function testSetWidth()
    {
        $this->rack->setWidth(200);
        $this->assertEquals(
            200,
            $this->attributes->getValue($this->rack)['width']
        );

        $this->rack->setWidth(null);
        $this->assertNull($this->attributes->getValue($this->rack)['width']);

        try {
            $this->rack->setWidth(-3);
        } catch (\DomainException $e) {
            $this->assertEquals('$width <= 0', $e->getMessage());
        }

        try {
            $this->rack->setWidth(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$width <= 0', $e->getMessage());
        }
    }

    public function testGetRoomId()
    {
        $this->attributes->setValue($this->rack, ['room_id' => 2]);
        $this->assertEquals(
            2,
            $this->rack->getRoomId()
        );

        $this->attributes->setValue($this->rack, ['room_id' => null]);
        $this->assertNull($this->rack->getRoomId());
    }

    public function testSetHasExternalUps()
    {
        $this->rack->setHasExternalUps(true);
        $this->assertTrue($this->attributes->getValue($this->rack)['has_external_ups']);

        $this->rack->setHasExternalUps(false);
        $this->assertFalse($this->attributes->getValue($this->rack)['has_external_ups']);

        $this->rack->setHasExternalUps(null);
        $this->assertNull($this->attributes->getValue($this->rack)['has_external_ups']);
    }

    public function testGetFrame()
    {
        $this->attributes->setValue($this->rack, ['frame' => 'Single frame']);
        $this->assertEquals(
            'Single frame',
            $this->rack->getFrame()
        );

        $this->attributes->setValue($this->rack, ['frame' => null]);
        $this->assertNull($this->rack->getFrame());
    }

    public function testSetName()
    {
        $this->rack->setName('Some name');
        $this->assertEquals(
            'Some name',
            $this->attributes->getValue($this->rack)['name']
        );

        $this->rack->setName(null);
        $this->assertNull($this->attributes->getValue($this->rack)['name']);
    }

    public function testSetId()
    {
        $this->rack->setId(4);
        $this->assertEquals(
            4,
            $this->attributes->getValue($this->rack)['id']
        );
    }

    public function testGetDepartmentId()
    {
        $this->attributes->setValue($this->rack, ['department_id' => 2]);
        $this->assertEquals(
            2,
            $this->rack->getDepartmentId()
        );

        $this->attributes->setValue($this->rack, ['department_id' => null]);
        $this->assertNull($this->rack->getDepartmentId());
    }

    public function testSetHasNumberingFromTopToBottom()
    {
        $this->rack->setHasNumberingFromTopToBottom(true);
        $this->assertTrue($this->attributes->getValue($this->rack)['has_numbering_from_top_to_bottom']);

        $this->rack->setHasNumberingFromTopToBottom(false);
        $this->assertFalse($this->attributes->getValue($this->rack)['has_numbering_from_top_to_bottom']);

        $this->rack->setHasNumberingFromTopToBottom(null);
        $this->assertNull($this->attributes->getValue($this->rack)['has_numbering_from_top_to_bottom']);
    }

    public function testGetHasCooler()
    {
        $this->attributes->setValue($this->rack, ['has_cooler' => true]);
        $this->assertTrue($this->rack->getHasCooler());

        $this->attributes->setValue($this->rack, ['has_cooler' => false]);
        $this->assertFalse($this->rack->getHasCooler());

        $this->attributes->setValue($this->rack, ['has_cooler' => null]);
        $this->assertNull($this->rack->getHasCooler());
    }

    public function testSetLinkToDocs()
    {
        $this->rack->setLinkToDocs('Some link');
        $this->assertEquals(
            'Some link',
            $this->attributes->getValue($this->rack)['link_to_docs']
        );

        $this->rack->setLinkToDocs(null);
        $this->assertNull($this->attributes->getValue($this->rack)['link_to_docs']);
    }

    public function testSetResponsible()
    {
        $this->rack->setResponsible('Some responsible');
        $this->assertEquals(
            'Some responsible',
            $this->attributes->getValue($this->rack)['responsible']
        );

        $this->rack->setResponsible(null);
        $this->assertNull($this->attributes->getValue($this->rack)['responsible']);
    }

    public function testGetName()
    {
        $this->attributes->setValue($this->rack, ['name' => 'Some name']);
        $this->assertEquals(
            'Some name',
            $this->rack->getName()
        );

        $this->attributes->setValue($this->rack, ['name' => null]);
        $this->assertNull($this->rack->getName());
    }

    public function testSetFixedAsset()
    {
        $this->rack->setFixedAsset('Some asset');
        $this->assertEquals(
            'Some asset',
            $this->attributes->getValue($this->rack)['fixed_asset']
        );

        $this->rack->setFixedAsset(null);
        $this->assertNull($this->attributes->getValue($this->rack)['fixed_asset']);
    }

    public function testGetHasNumberingFromTopToBottom()
    {
        $this->attributes->setValue($this->rack, ['has_numbering_from_top_to_bottom' => true]);
        $this->assertTrue($this->rack->getHasNumberingFromTopToBottom());

        $this->attributes->setValue($this->rack, ['has_numbering_from_top_to_bottom' => false]);
        $this->assertFalse($this->rack->getHasNumberingFromTopToBottom());

        $this->attributes->setValue($this->rack, ['has_numbering_from_top_to_bottom' => null]);
        $this->assertNull($this->rack->getHasNumberingFromTopToBottom());
    }

    public function testGetWidth()
    {
        $this->attributes->setValue($this->rack, ['width' => 500]);
        $this->assertEquals(
            500,
            $this->rack->getWidth()
        );

        $this->attributes->setValue($this->rack, ['width' => null]);
        $this->assertNull($this->rack->getWidth());
    }

    public function testSetPlaceType()
    {
        $this->rack->setPlaceType('Floor standing');
        $this->assertEquals(
            'Floor standing',
            $this->attributes->getValue($this->rack)['place_type']
        );

        $this->rack->setPlaceType(null);
        $this->assertNull($this->attributes->getValue($this->rack)['place_type']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$placeType is not in RackPlaceTypeEnum');
        $this->rack->setPlaceType('Oops');
    }

    public function testSetOldName()
    {
        $this->rack->setOldName('Old name');
        $this->assertEquals(
            'Old name',
            $this->attributes->getValue($this->rack)['old_name']
        );

        $this->rack->setOldName(null);
        $this->assertNull($this->attributes->getValue($this->rack)['old_name']);
    }

    public function testGetVendor()
    {
        $this->attributes->setValue($this->rack, ['vendor' => 'Some vendor']);
        $this->assertEquals(
            'Some vendor',
            $this->rack->getVendor()
        );

        $this->attributes->setValue($this->rack, ['vendor' => null]);
        $this->assertNull($this->rack->getVendor());
    }

    public function testGetDepth()
    {
        $this->attributes->setValue($this->rack, ['depth' => 300]);
        $this->assertEquals(
            300,
            $this->rack->getDepth()
        );

        $this->attributes->setValue($this->rack, ['depth' => null]);
        $this->assertNull($this->rack->getDepth());
    }

    public function testGetUpdatedAt()
    {
        $this->attributes->setValue($this->rack, ['updated_at' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->rack->getUpdatedAt()
        );
    }

    public function testSetPowerSocketsUps()
    {
        $this->rack->setPowerSocketsUps(7);
        $this->assertEquals(
            7,
            $this->attributes->getValue($this->rack)['power_sockets_ups']
        );

        $this->rack->setPowerSocketsUps(null);
        $this->assertNull($this->attributes->getValue($this->rack)['power_sockets_ups']);

        try {
            $this->rack->setPowerSocketsUps(-10);
        } catch (\DomainException $e) {
            $this->assertEquals('$powerSocketsUps <= 0', $e->getMessage());
        }

        try {
            $this->rack->setPowerSocketsUps(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$powerSocketsUps <= 0', $e->getMessage());
        }
    }

    public function testSetHasCooler()
    {
        $this->rack->setHasCooler(true);
        $this->assertTrue($this->attributes->getValue($this->rack)['has_cooler']);

        $this->rack->setHasCooler(false);
        $this->assertFalse($this->attributes->getValue($this->rack)['has_cooler']);

        $this->rack->setHasCooler(null);
        $this->assertNull($this->attributes->getValue($this->rack)['has_cooler']);
    }

    public function testGetFixedAsset()
    {
        $this->attributes->setValue($this->rack, ['fixed_asset' => '4655585']);
        $this->assertEquals(
            '4655585',
            $this->rack->getFixedAsset()
        );

        $this->attributes->setValue($this->rack, ['fixed_asset' => null]);
        $this->assertNull($this->rack->getFixedAsset());
    }

    public function testSetRow()
    {
        $this->rack->setRow('Some row');
        $this->assertEquals(
            'Some row',
            $this->attributes->getValue($this->rack)['row']
        );

        $this->rack->setRow(null);
        $this->assertNull($this->attributes->getValue($this->rack)['row']);
    }

    public function testGetRow()
    {
        $this->attributes->setValue($this->rack, ['row' => 'Some row']);
        $this->assertEquals(
            'Some row',
            $this->rack->getRow()
        );

        $this->attributes->setValue($this->rack, ['row' => null]);
        $this->assertNull($this->rack->getRow());
    }

    public function testGetInventoryNumber()
    {
        $this->attributes->setValue($this->rack, ['inventory_number' => '5423424234']);
        $this->assertEquals(
            '5423424234',
            $this->rack->getInventoryNumber()
        );

        $this->attributes->setValue($this->rack, ['inventory_number' => null]);
        $this->assertNull($this->rack->getInventoryNumber());
    }

    public function testGetUpdatedBy()
    {
        $this->attributes->setValue($this->rack, ['updated_by' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->rack->getUpdatedBy()
        );

        $this->attributes->setValue($this->rack, ['updated_by' => null]);
        $this->assertNull($this->rack->getUpdatedBy());
    }

    public function testSetAmount()
    {
        $this->rack->setAmount(22);
        $this->assertEquals(
            22,
            $this->attributes->getValue($this->rack)['amount']
        );

        $this->rack->setAmount(null);
        $this->assertNull($this->attributes->getValue($this->rack)['amount']);

        try {
            $this->rack->setAmount(-2);
        } catch (\DomainException $e) {
            $this->assertEquals('$amount <= 0', $e->getMessage());
        }

        try {
            $this->rack->getAmount(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$amount <= 0', $e->getMessage());
        }
    }

    public function testSetFrame()
    {
        $this->rack->setFrame('Single frame');
        $this->assertEquals(
            'Single frame',
            $this->attributes->getValue($this->rack)['frame']
        );

        $this->rack->setFrame(null);
        $this->assertNull($this->attributes->getValue($this->rack)['frame']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$frame is not in RackFrameEnum');
        $this->rack->setFrame('Oops');
    }

    public function testGetDescription()
    {
        $this->attributes->setValue($this->rack, ['description' => 'Some description']);
        $this->assertEquals(
            'Some description',
            $this->rack->getDescription()
        );

        $this->attributes->setValue($this->rack, ['description' => null]);
        $this->assertNull($this->rack->getDescription());
    }

    public function testSetFinanciallyResponsiblePerson()
    {
        $this->rack->setFinanciallyResponsiblePerson('Some person');
        $this->assertEquals(
            'Some person',
            $this->attributes->getValue($this->rack)['financially_responsible_person']
        );

        $this->rack->setFinanciallyResponsiblePerson(null);
        $this->assertNull($this->attributes->getValue($this->rack)['financially_responsible_person']);
    }
}
