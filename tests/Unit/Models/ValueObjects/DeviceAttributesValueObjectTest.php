<?php

declare(strict_types=1);

namespace Tests\Unit\Models\ValueObjects;

use App\Models\Device;
use App\Models\ValueObjects\DeviceAttributesValueObject;
use App\Models\ValueObjects\DeviceUnitsValueObject;
use Tests\TestCase;

class DeviceAttributesValueObjectTest extends TestCase
{
    public function testSetRackId(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getRackId')
            ->willReturn(4);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setRackId');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['rack_id' => 4],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getRackId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setRackId');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetUnits(): void
    {
        // Attr not null
        $deviceUnitsMock = $this->createMock(DeviceUnitsValueObject::class);
        $deviceUnitsMock->expects($this->once())
            ->method('toArray')
            ->willReturn([3, 4, 5]);

        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn($deviceUnitsMock);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setUnits');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['units' => '[3,4,5]'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is empty array
        $deviceUnitsMock = $this->createMock(DeviceUnitsValueObject::class);
        $deviceUnitsMock->expects($this->once())
            ->method('toArray')
            ->willReturn([]);

        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getUnits')
            ->willReturn($deviceUnitsMock);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setUnits');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetLocation(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(true);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setLocation');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['has_backside_location' => true],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getLocation')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setLocation');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetModel(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getModel')
            ->willReturn('model');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setModel');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['model' => 'model'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getModel')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setModel');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetVendor(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getVendor')
            ->willReturn('vendor');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setVendor');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['vendor' => 'vendor'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getVendor')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setVendor');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetUpdatedBy(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn('user');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setUpdatedBy');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['updated_by' => 'user'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setUpdatedBy');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetType(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getType')
            ->willReturn('Other');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setType');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['type' => 'Other'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getType')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setType');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetStatus(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getStatus')
            ->willReturn('Active');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setStatus');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['status' => 'Active'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getStatus')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setStatus');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetHostname(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getHostname')
            ->willReturn('hostname');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setHostname');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['hostname' => 'hostname'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getHostname')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setHostname');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetIp(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getIp')
            ->willReturn('192.168.10.10');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setIp');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['ip' => '192.168.10.10'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getIp')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setIp');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetPortsAmount(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPortsAmount')
            ->willReturn(24);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPortsAmount');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['ports_amount' => 24],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPortsAmount')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPortsAmount');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetSoftwareVersion(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getSoftwareVersion')
            ->willReturn('v12');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setSoftwareVersion');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['software_version' => 'v12'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getSoftwareVersion')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setSoftwareVersion');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetPowerType(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPowerType')
            ->willReturn('Other');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerType');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['power_type' => 'Other'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPowerType')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerType');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetPowerW(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPowerW')
            ->willReturn(200);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerW');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['power_w' => 200],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPowerW')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerW');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetPowerV(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPowerV')
            ->willReturn(220);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerV');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['power_v' => 220],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPowerV')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerV');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetPowerACDC(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPowerACDC')
            ->willReturn('AC');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerACDC');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['power_ac_dc' => 'AC'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getPowerACDC')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerACDC');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetSerialNumber(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getSerialNumber')
            ->willReturn('123142352');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setSerialNumber');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['serial_number' => '123142352'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getSerialNumber')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setSerialNumber');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetDescription(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getDescription')
            ->willReturn('description');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setDescription');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['description' => 'description'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getDescription')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setDescription');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetProject(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getProject')
            ->willReturn('project');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setProject');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['project' => 'project'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getProject')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setProject');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetOwnership(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getOwnership')
            ->willReturn('ownership');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setOwnership');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['ownership' => 'ownership'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getOwnership')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setOwnership');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetResponsible(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getResponsible')
            ->willReturn('responsible');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setResponsible');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['responsible' => 'responsible'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getResponsible')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setResponsible');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetFinanciallyResponsiblePerson(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getFinanciallyResponsiblePerson')
            ->willReturn('responsible');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setFinanciallyResponsiblePerson');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['financially_responsible_person' => 'responsible'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getFinanciallyResponsiblePerson')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setFinanciallyResponsiblePerson');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetInventoryNumber(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getInventoryNumber')
            ->willReturn('3426546245645');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setInventoryNumber');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['inventory_number' => '3426546245645'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getInventoryNumber')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setInventoryNumber');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetFixedAsset(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getFixedAsset')
            ->willReturn('3426546245');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setFixedAsset');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['fixed_asset' => '3426546245'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getFixedAsset')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setFixedAsset');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetLinkToDocs(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getLinkToDocs')
            ->willReturn('link');

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setLinkToDocs');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['link_to_docs' => 'link'],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getLinkToDocs')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setLinkToDocs');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testSetDepartmentId(): void
    {
        // Attr not null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(3);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setDepartmentId');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['department_id' => 3],
            $attributesForDeviceProp->getValue($attrsMock)
        );

        // Attr is null
        $deviceMock = $this->createMock(Device::class);
        $deviceMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $method = $reflection->getMethod('setDepartmentId');
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');
        $deviceProp = $reflection->getProperty('device');
        $deviceProp->setValue($attrsMock, $deviceMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testToArray(): void
    {
        $attrsMock = $this->getMockBuilder(DeviceAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(DeviceAttributesValueObject::class);
        $attributesForDeviceProp = $reflection->getProperty('attributesForDevice');

        $attributesForDeviceProp->setValue($attrsMock, ['oops' => 'oops']);
        $this->assertEquals(
            $attrsMock->toArray(),
            $attributesForDeviceProp->getValue($attrsMock)
        );
    }

    public function testConstructor()
    {
        $device = new Device([
            'rack_id' => 2,
            'units' => '[1,2,3]',
            'has_backside_location' => true,
            'model' => 'model',
            'vendor' => 'vendor',
            'updated_by' => 'user',
            'type' => 'Other',
            'status' => 'Active',
            'hostname' => 'hostname',
            'ip' => '192.168.10.10',
            'ports_amount' => 24,
            'software_version' => 'v12',
            'power_type' => 'Other',
            'power_w' => 200,
            'power_v' => 220,
            'power_ac_dc' => 'AC',
            'serial_number' => '1343412',
            'description' => 'description',
            'project' => 'project',
            'ownership' => 'owner',
            'responsible' => 'responsible',
            'financially_responsible_person' => 'responsible',
            'inventory_number' => '1221344',
            'fixed_asset' => '4323123412445',
            'link_to_docs' => 'link',
            'department_id' => 12,
        ]);
        $deviceAttrsValueObj = new DeviceAttributesValueObject($device);
        $this->assertEquals(
            [
                'rack_id' => 2,
                'units' => '[1,2,3]',
                'has_backside_location' => true,
                'model' => 'model',
                'vendor' => 'vendor',
                'updated_by' => 'user',
                'type' => 'Other',
                'status' => 'Active',
                'hostname' => 'hostname',
                'ip' => '192.168.10.10',
                'ports_amount' => 24,
                'software_version' => 'v12',
                'power_type' => 'Other',
                'power_w' => 200,
                'power_v' => 220,
                'power_ac_dc' => 'AC',
                'serial_number' => '1343412',
                'description' => 'description',
                'project' => 'project',
                'ownership' => 'owner',
                'responsible' => 'responsible',
                'financially_responsible_person' => 'responsible',
                'inventory_number' => '1221344',
                'fixed_asset' => '4323123412445',
                'link_to_docs' => 'link',
                'department_id' => 12,
            ],
            $deviceAttrsValueObj->toArray()
        );

        $device = new Device([
            'rack_id' => 2,
            'units' => '[1,2,3]',
            'has_backside_location' => true,
            'model' => null,
            'vendor' => 'vendor',
            'updated_by' => 'user',
            'type' => 'Other',
            'status' => 'Active',
            'hostname' => 'hostname',
            'ip' => '192.168.10.10',
            'ports_amount' => null,
            'software_version' => 'v12',
            'power_type' => 'Other',
            'power_w' => 200,
            'power_v' => 220,
            'power_ac_dc' => 'AC',
            'serial_number' => '1343412',
            'description' => 'description',
            'project' => 'project',
            'ownership' => null,
            'responsible' => 'responsible',
            'financially_responsible_person' => 'responsible',
            'inventory_number' => '1221344',
            'fixed_asset' => '4323123412445',
            'link_to_docs' => 'link',
            'department_id' => 12,
        ]);
        $deviceAttrsValueObj = new DeviceAttributesValueObject($device);
        $this->assertEquals(
            [
                'rack_id' => 2,
                'units' => '[1,2,3]',
                'has_backside_location' => true,
                'vendor' => 'vendor',
                'updated_by' => 'user',
                'type' => 'Other',
                'status' => 'Active',
                'hostname' => 'hostname',
                'ip' => '192.168.10.10',
                'software_version' => 'v12',
                'power_type' => 'Other',
                'power_w' => 200,
                'power_v' => 220,
                'power_ac_dc' => 'AC',
                'serial_number' => '1343412',
                'description' => 'description',
                'project' => 'project',
                'responsible' => 'responsible',
                'financially_responsible_person' => 'responsible',
                'inventory_number' => '1221344',
                'fixed_asset' => '4323123412445',
                'link_to_docs' => 'link',
                'department_id' => 12,
            ],
            $deviceAttrsValueObj->toArray()
        );
    }
}
