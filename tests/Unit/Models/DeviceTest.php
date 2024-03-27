<?php

namespace Tests\Unit\Models;

use App\Models\Device;
use App\Models\ValueObjects\DeviceUnitsValueObject;
use Tests\TestCase;

class DeviceTest extends TestCase
{
    public $device; // Mock

    public $attributes; // Reflection property

    public function setUp(): void
    {
        parent::setUp();

        $this->device = $this->getMockBuilder(Device::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(Device::class);
        $this->attributes = $reflection->getProperty('attributes');
        $this->attributes->setAccessible(true);
    }

    public function testGetUnits()
    {
        // Testing injected DeviceUnitsValueObject via app()->make()
        $this->attributes->setValue(
            $this->device, ['units' => '[]']
        );

        $unitsMock = $this->getMockBuilder(DeviceUnitsValueObject::class)
            ->onlyMethods(['toArray'])
            ->setConstructorArgs([[1, 2, 3]])
            ->getMock();

        $unitsMock->method('toArray')
            ->willReturn([1, 2, 3]);

        $this->app->bind(DeviceUnitsValueObject::class, function () use ($unitsMock) {
            return $unitsMock;
        });

        $this->assertEquals(
            [1, 2, 3],
            $this->device->getUnits()->toArray(),
        );

        $this->app->offsetUnset(DeviceUnitsValueObject::class);

        // $units is an instanceof DeviceUnitsValueObject
        $this->attributes->setValue(
            $this->device, ['units' => $unitsMock]
        );
        $this->assertEquals(
            [1, 2, 3],
            $this->device->getUnits()->toArray(),
        );

        // Unbind mock
        $this->app->offsetUnset(DeviceUnitsValueObject::class);

        // $units is a string
        $this->attributes->setValue(
            $this->device, ['units' => '[3, 4, 5, 6]']
        );
        $this->assertEquals(
            [3, 4, 5, 6],
            $this->device->getUnits()->toArray(),
        );

        // $units is an array
        $this->attributes->setValue(
            $this->device, ['units' => [3, 4, 5, 6]]
        );
        $this->assertEquals(
            [3, 4, 5, 6],
            $this->device->getUnits()->toArray(),
        );

        // $units is not JSONable
        $this->attributes->setValue(
            $this->device, ['units' => 'fytnfgsfghsfghfhgb']
        );
        try {
            $this->device->getUnits();
        } catch (\DomainException $e) {
            $this->assertEquals('$units json decode failed', $e->getMessage());
        }

        // Main throw
        $this->attributes->setValue(
            $this->device, ['units' => 1234]
        );
        try {
            $this->device->getUnits();
        } catch (\DomainException $e) {
            $this->assertEquals('$units dont match any allowed type', $e->getMessage());
        }
    }

    public function testSetUnits()
    {
        $this->attributes->setValue(
            $this->device, ['units' => '[]']
        );
        $unitsMock = $this->getMockBuilder(DeviceUnitsValueObject::class)
            ->onlyMethods(['toArray'])
            ->setConstructorArgs([[3, 4, 5]])
            ->getMock();
        $unitsMock->method('toArray')
            ->willReturn([3, 4, 5]);

        $this->device->setUnits($unitsMock);
        $this->assertEquals(
            $unitsMock->toArray(),
            $this->attributes->getValue($this->device)['units']->toArray()
        );
    }

    public function testGetId()
    {
        $this->attributes->setValue($this->device, ['id' => 12]);
        $this->assertEquals(
            12,
            $this->device->getId()
        );
    }

    public function testGetVendor()
    {
        $this->attributes->setValue($this->device, ['vendor' => 'some vendor']);
        $this->assertEquals(
            'some vendor',
            $this->device->getVendor()
        );

        $this->attributes->setValue($this->device, ['vendor' => null]);
        $this->assertNull($this->device->getVendor());
    }

    public function testSetVendor()
    {
        $this->device->setVendor('some vendor');
        $this->assertEquals(
            'some vendor',
            $this->attributes->getValue($this->device)['vendor']
        );

        $this->device->setVendor(null);
        $this->assertNull($this->attributes->getValue($this->device)['vendor']);
    }

    public function testGetModel()
    {
        $this->attributes->setValue($this->device, ['model' => 'some model']);
        $this->assertEquals(
            'some model',
            $this->device->getModel()
        );

        $this->attributes->setValue($this->device, ['model' => null]);
        $this->assertNull($this->device->getModel());
    }

    public function testSetModel()
    {
        $this->device->setModel('some model');
        $this->assertEquals(
            'some model',
            $this->attributes->getValue($this->device)['model']
        );

        $this->device->setModel(null);
        $this->assertNull($this->attributes->getValue($this->device)['model']);
    }

    public function testGetType()
    {
        $this->attributes->setValue($this->device, ['type' => 'Switch']);
        $this->assertEquals(
            'Switch',
            $this->device->getType()
        );

        $this->attributes->setValue($this->device, ['type' => null]);
        $this->assertNull($this->device->getType());
    }

    public function testSetType()
    {
        $this->device->setType('Router');
        $this->assertEquals(
            'Router',
            $this->attributes->getValue($this->device)['type']
        );

        $this->device->setType(null);
        $this->assertNull($this->attributes->getValue($this->device)['type']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$type is not in DeviceTypeEnum');
        $this->device->setType('Oops');
    }

    public function testGetStatus()
    {
        $this->attributes->setValue($this->device, ['status' => 'Device active']);
        $this->assertEquals(
            'Device active',
            $this->device->getStatus()
        );

        $this->attributes->setValue($this->device, ['status' => null]);
        $this->assertNull($this->device->getStatus());
    }

    public function testSetStatus()
    {
        $this->device->setStatus('Device active');
        $this->assertEquals(
            'Device active',
            $this->attributes->getValue($this->device)['status']
        );

        $this->device->setStatus(null);
        $this->assertNull($this->attributes->getValue($this->device)['status']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$status is not in DeviceStatusEnum');
        $this->device->setStatus('Oops');
    }

    public function testGetHostname()
    {
        $this->attributes->setValue($this->device, ['hostname' => 'some hostname']);
        $this->assertEquals(
            'some hostname',
            $this->device->getHostname()
        );

        $this->attributes->setValue($this->device, ['hostname' => null]);
        $this->assertNull($this->device->getHostname());
    }

    public function testSetHostname()
    {
        $this->device->setHostname('some hostname');
        $this->assertEquals(
            'some hostname',
            $this->attributes->getValue($this->device)['hostname']
        );

        $this->device->setHostname(null);
        $this->assertNull($this->attributes->getValue($this->device)['hostname']);
    }

    public function testSetIp()
    {
        $this->device->setIp('192.168.10.10');
        $this->assertEquals(
            '192.168.10.10',
            $this->attributes->getValue($this->device)['ip']
        );

        $this->device->setIp(null);
        $this->assertNull($this->attributes->getValue($this->device)['ip']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$ip is not valid');
        $this->device->setIp('192.16a.10.10');
    }

    public function testGetIp()
    {
        $this->attributes->setValue($this->device, ['ip' => '192.168.10.10']);
        $this->assertEquals(
            '192.168.10.10',
            $this->device->getIp()
        );

        $this->attributes->setValue($this->device, ['ip' => null]);
        $this->assertNull($this->device->getIp());
    }
}
