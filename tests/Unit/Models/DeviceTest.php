<?php

namespace Tests\Unit\Models;

use App\Models\Device;
use App\Models\ValueObjects\DeviceUnitsValueObject;
use Tests\TestCase;

class DeviceTest extends TestCase
{
    public $device; // @phpstan-ignore-line

    public $attributes; // @phpstan-ignore-line

    public function setUp(): void
    {
        parent::setUp();

        // Mock for Getters and Setters
        $this->device = $this->getMockBuilder(Device::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(Device::class);
        $this->attributes = $reflection->getProperty('attributes');
    }

    public function testGetUnits(): void
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
            $this->device, ['units' => [3, 4, 5, 6, 7]]
        );
        $this->assertEquals(
            [3, 4, 5, 6, 7],
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

    public function testSetUnits(): void
    {
        $this->attributes->setValue(
            $this->device, ['units' => '[]']
        );
        $unitsMock = $this->getMockBuilder(DeviceUnitsValueObject::class)
            ->onlyMethods(['toArray'])
            ->setConstructorArgs([[4, 5]])
            ->getMock();
        $unitsMock->method('toArray')
            ->willReturn([4, 5]);

        $this->device->setUnits($unitsMock);
        $this->assertEquals(
            $unitsMock->toArray(),
            $this->attributes->getValue($this->device)['units']->toArray()
        );
    }

    public function testGetId(): void
    {
        $this->attributes->setValue($this->device, ['id' => 12]);
        $this->assertEquals(
            12,
            $this->device->getId()
        );
    }

    public function testGetVendor(): void
    {
        $this->attributes->setValue($this->device, ['vendor' => 'some vendor']);
        $this->assertEquals(
            'some vendor',
            $this->device->getVendor()
        );

        $this->attributes->setValue($this->device, ['vendor' => null]);
        $this->assertNull($this->device->getVendor());
    }

    public function testSetVendor(): void
    {
        $this->device->setVendor('some other vendor');
        $this->assertEquals(
            'some other vendor',
            $this->attributes->getValue($this->device)['vendor']
        );

        $this->device->setVendor(null);
        $this->assertNull($this->attributes->getValue($this->device)['vendor']);
    }

    public function testGetModel(): void
    {
        $this->attributes->setValue($this->device, ['model' => 'some model']);
        $this->assertEquals(
            'some model',
            $this->device->getModel()
        );

        $this->attributes->setValue($this->device, ['model' => null]);
        $this->assertNull($this->device->getModel());
    }

    public function testSetModel(): void
    {
        $this->device->setModel('some other model');
        $this->assertEquals(
            'some other model',
            $this->attributes->getValue($this->device)['model']
        );

        $this->device->setModel(null);
        $this->assertNull($this->attributes->getValue($this->device)['model']);
    }

    public function testGetType(): void
    {
        $this->attributes->setValue($this->device, ['type' => 'Switch']);
        $this->assertEquals(
            'Switch',
            $this->device->getType()
        );

        $this->attributes->setValue($this->device, ['type' => null]);
        $this->assertNull($this->device->getType());
    }

    public function testSetType(): void
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

    public function testGetStatus(): void
    {
        $this->attributes->setValue($this->device, ['status' => 'Device active']);
        $this->assertEquals(
            'Device active',
            $this->device->getStatus()
        );

        $this->attributes->setValue($this->device, ['status' => null]);
        $this->assertNull($this->device->getStatus());
    }

    public function testSetStatus(): void
    {
        $this->device->setStatus('Device failed');
        $this->assertEquals(
            'Device failed',
            $this->attributes->getValue($this->device)['status']
        );

        $this->device->setStatus(null);
        $this->assertNull($this->attributes->getValue($this->device)['status']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$status is not in DeviceStatusEnum');
        $this->device->setStatus('Oops');
    }

    public function testGetHostname(): void
    {
        $this->attributes->setValue($this->device, ['hostname' => 'some hostname']);
        $this->assertEquals(
            'some hostname',
            $this->device->getHostname()
        );

        $this->attributes->setValue($this->device, ['hostname' => null]);
        $this->assertNull($this->device->getHostname());
    }

    public function testSetHostname(): void
    {
        $this->device->setHostname('some other hostname');
        $this->assertEquals(
            'some other hostname',
            $this->attributes->getValue($this->device)['hostname']
        );

        $this->device->setHostname(null);
        $this->assertNull($this->attributes->getValue($this->device)['hostname']);
    }

    public function testSetIp(): void
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

    public function testGetIp(): void
    {
        $this->attributes->setValue($this->device, ['ip' => '192.168.10.11']);
        $this->assertEquals(
            '192.168.10.11',
            $this->device->getIp()
        );

        $this->attributes->setValue($this->device, ['ip' => null]);
        $this->assertNull($this->device->getIp());
    }

    public function testGetStack(): void
    {
        $this->attributes->setValue($this->device, ['stack' => 12]);
        $this->assertEquals(
            12,
            $this->device->getStack()
        );

        $this->attributes->setValue($this->device, ['stack' => null]);
        $this->assertNull($this->device->getStack());
    }

    public function testSetStack(): void
    {
        $this->device->setStack(11);
        $this->assertEquals(
            11,
            $this->attributes->getValue($this->device)['stack']
        );

        $this->device->setStack(null);
        $this->assertNull($this->attributes->getValue($this->device)['stack']);

        try {
            $this->device->setStack(-10);
        } catch (\DomainException $e) {
            $this->assertEquals('$stack <= 0', $e->getMessage());
        }

        try {
            $this->device->setStack(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$stack <= 0', $e->getMessage());
        }
    }

    public function testGetPortsAmount(): void
    {
        $this->attributes->setValue($this->device, ['ports_amount' => 15]);
        $this->assertEquals(
            15,
            $this->device->getPortsAmount()
        );

        $this->attributes->setValue($this->device, ['ports_amount' => null]);
        $this->assertNull($this->device->getPortsAmount());
    }

    public function testSetPortsAmount(): void
    {
        $this->device->setPortsAmount(14);
        $this->assertEquals(
            14,
            $this->attributes->getValue($this->device)['ports_amount']
        );

        $this->device->setPortsAmount(null);
        $this->assertNull($this->attributes->getValue($this->device)['ports_amount']);

        try {
            $this->device->setPortsAmount(-11);
        } catch (\DomainException $e) {
            $this->assertEquals('$portsAmount <= 0', $e->getMessage());
        }

        try {
            $this->device->setPortsAmount(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$portsAmount <= 0', $e->getMessage());
        }
    }

    public function testGetSoftwareVersion(): void
    {
        $this->attributes->setValue($this->device, ['software_version' => 'v12.4']);
        $this->assertEquals(
            'v12.4',
            $this->device->getSoftwareVersion()
        );

        $this->attributes->setValue($this->device, ['software_version' => null]);
        $this->assertNull($this->device->getSoftwareVersion());
    }

    public function testSetSoftwareVersion(): void
    {
        $this->device->setSoftwareVersion('v12.49');
        $this->assertEquals(
            'v12.49',
            $this->attributes->getValue($this->device)['software_version']
        );

        $this->device->setSoftwareVersion(null);
        $this->assertNull($this->attributes->getValue($this->device)['software_version']);
    }

    public function testGetPowerType(): void
    {
        $this->attributes->setValue($this->device, ['power_type' => 'IEC C14 socket']);
        $this->assertEquals(
            'IEC C14 socket',
            $this->device->getPowerType()
        );

        $this->attributes->setValue($this->device, ['power_type' => null]);
        $this->assertNull($this->device->getPowerType());
    }

    public function testSetPowerType(): void
    {
        $this->device->setPowerType('Other');
        $this->assertEquals(
            'Other',
            $this->attributes->getValue($this->device)['power_type']
        );

        $this->device->setPowerType(null);
        $this->assertNull($this->attributes->getValue($this->device)['power_type']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$powerType is not in DevicePowerTypeEnum');
        $this->device->setPowerType('Oops');
    }

    public function testGetPowerW(): void
    {
        $this->attributes->setValue($this->device, ['power_w' => 15]);
        $this->assertEquals(
            15,
            $this->device->getPowerW()
        );

        $this->attributes->setValue($this->device, ['power_w' => null]);
        $this->assertNull($this->device->getPowerW());
    }

    public function testSetPowerW(): void
    {
        $this->device->setPowerW(14);
        $this->assertEquals(
            14,
            $this->attributes->getValue($this->device)['power_w']
        );

        $this->device->setPowerW(null);
        $this->assertNull($this->attributes->getValue($this->device)['power_w']);

        try {
            $this->device->setPowerW(-11);
        } catch (\DomainException $e) {
            $this->assertEquals('$powerW <= 0', $e->getMessage());
        }

        try {
            $this->device->setPowerW(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$powerW <= 0', $e->getMessage());
        }
    }

    public function testGetPowerV(): void
    {
        $this->attributes->setValue($this->device, ['power_v' => 15]);
        $this->assertEquals(
            15,
            $this->device->getPowerV()
        );

        $this->attributes->setValue($this->device, ['power_v' => null]);
        $this->assertNull($this->device->getPowerV());
    }

    public function testSetPowerV(): void
    {
        $this->device->setPowerV(14);
        $this->assertEquals(
            14,
            $this->attributes->getValue($this->device)['power_v']
        );

        $this->device->setPowerV(null);
        $this->assertNull($this->attributes->getValue($this->device)['power_v']);

        try {
            $this->device->setPowerV(-11);
        } catch (\DomainException $e) {
            $this->assertEquals('$powerV <= 0', $e->getMessage());
        }

        try {
            $this->device->setPowerV(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$powerV <= 0', $e->getMessage());
        }
    }

    public function testGetPowerACDC(): void
    {
        $this->attributes->setValue($this->device, ['power_ac_dc' => 'DC']);
        $this->assertEquals(
            'DC',
            $this->device->getPowerACDC()
        );

        $this->attributes->setValue($this->device, ['power_ac_dc' => null]);
        $this->assertNull($this->device->getPowerACDC());
    }

    public function testSetPowerACDC(): void
    {
        $this->device->setPowerACDC('AC');
        $this->assertEquals(
            'AC',
            $this->attributes->getValue($this->device)['power_ac_dc']
        );

        $this->device->setPowerACDC(null);
        $this->assertNull($this->attributes->getValue($this->device)['power_ac_dc']);

        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('$powerACDC is not in DevicePowerACDCEnum');
        $this->device->setPowerACDC('Oops');
    }

    public function testGetSerialNumber(): void
    {
        $this->attributes->setValue($this->device, ['serial_number' => 'FRG1728393']);
        $this->assertEquals(
            'FRG1728393',
            $this->device->getSerialNumber()
        );

        $this->attributes->setValue($this->device, ['serial_number' => null]);
        $this->assertNull($this->device->getSerialNumber());
    }

    public function testSetSerialNumber(): void
    {
        $this->device->setSerialNumber('FRG17283909');
        $this->assertEquals(
            'FRG17283909',
            $this->attributes->getValue($this->device)['serial_number']
        );

        $this->device->setSerialNumber(null);
        $this->assertNull($this->attributes->getValue($this->device)['serial_number']);
    }

    public function testGetDescription(): void
    {
        $this->attributes->setValue($this->device, ['description' => 'Some description']);
        $this->assertEquals(
            'Some description',
            $this->device->getDescription()
        );

        $this->attributes->setValue($this->device, ['description' => null]);
        $this->assertNull($this->device->getDescription());
    }

    public function testSetDescription(): void
    {
        $this->device->setDescription('Some other description');
        $this->assertEquals(
            'Some other description',
            $this->attributes->getValue($this->device)['description']
        );

        $this->device->setDescription(null);
        $this->assertNull($this->attributes->getValue($this->device)['description']);
    }

    public function testGetProject(): void
    {
        $this->attributes->setValue($this->device, ['project' => 'Some project']);
        $this->assertEquals(
            'Some project',
            $this->device->getProject()
        );

        $this->attributes->setValue($this->device, ['project' => null]);
        $this->assertNull($this->device->getProject());
    }

    public function testSetProject(): void
    {
        $this->device->setProject('Some other project');
        $this->assertEquals(
            'Some other project',
            $this->attributes->getValue($this->device)['project']
        );

        $this->device->setProject(null);
        $this->assertNull($this->attributes->getValue($this->device)['project']);
    }

    public function testGetOwnership(): void
    {
        $this->attributes->setValue($this->device, ['ownership' => 'Some ownership']);
        $this->assertEquals(
            'Some ownership',
            $this->device->getOwnership()
        );

        $this->attributes->setValue($this->device, ['ownership' => null]);
        $this->assertNull($this->device->getOwnership());
    }

    public function testSetOwnership(): void
    {
        $this->device->setOwnership('Some other ownership');
        $this->assertEquals(
            'Some other ownership',
            $this->attributes->getValue($this->device)['ownership']
        );

        $this->device->setOwnership(null);
        $this->assertNull($this->attributes->getValue($this->device)['ownership']);
    }

    public function testGetResponsible(): void
    {
        $this->attributes->setValue($this->device, ['responsible' => 'Some responsible']);
        $this->assertEquals(
            'Some responsible',
            $this->device->getResponsible()
        );

        $this->attributes->setValue($this->device, ['responsible' => null]);
        $this->assertNull($this->device->getResponsible());
    }

    public function testSetResponsible(): void
    {
        $this->device->setResponsible('Some other responsible');
        $this->assertEquals(
            'Some other responsible',
            $this->attributes->getValue($this->device)['responsible']
        );

        $this->device->setResponsible(null);
        $this->assertNull($this->attributes->getValue($this->device)['responsible']);
    }

    public function testGetFinanciallyResponsiblePerson(): void
    {
        $this->attributes
            ->setValue($this->device, ['financially_responsible_person' => 'Some financially responsible person']);
        $this->assertEquals(
            'Some financially responsible person',
            $this->device->getFinanciallyResponsiblePerson()
        );

        $this->attributes->setValue($this->device, ['financially_responsible_person' => null]);
        $this->assertNull($this->device->getFinanciallyResponsiblePerson());
    }

    public function testSetFinanciallyResponsiblePerson(): void
    {
        $this->device
            ->setFinanciallyResponsiblePerson('Some other financially responsible person');
        $this->assertEquals(
            'Some other financially responsible person',
            $this->attributes->getValue($this->device)['financially_responsible_person']
        );

        $this->device->setFinanciallyResponsiblePerson(null);
        $this->assertNull($this->attributes->getValue($this->device)['financially_responsible_person']);
    }

    public function testGetInventoryNumber(): void
    {
        $this->attributes->setValue($this->device, ['inventory_number' => 'Some inventory number']);
        $this->assertEquals(
            'Some inventory number',
            $this->device->getInventoryNumber()
        );

        $this->attributes->setValue($this->device, ['inventory_number' => null]);
        $this->assertNull($this->device->getInventoryNumber());
    }

    public function testSetInventoryNumber(): void
    {
        $this->device->setInventoryNumber('Some other inventory number');
        $this->assertEquals(
            'Some other inventory number',
            $this->attributes->getValue($this->device)['inventory_number']
        );

        $this->device->setInventoryNumber(null);
        $this->assertNull($this->attributes->getValue($this->device)['inventory_number']);
    }

    public function testGetFixedAsset(): void
    {
        $this->attributes->setValue($this->device, ['fixed_asset' => 'Some fixed asset']);
        $this->assertEquals(
            'Some fixed asset',
            $this->device->getFixedAsset()
        );

        $this->attributes->setValue($this->device, ['fixed_asset' => null]);
        $this->assertNull($this->device->getFixedAsset());
    }

    public function testSetFixedAsset(): void
    {
        $this->device->setFixedAsset('Some other fixed asset');
        $this->assertEquals(
            'Some other fixed asset',
            $this->attributes->getValue($this->device)['fixed_asset']
        );

        $this->device->setFixedAsset(null);
        $this->assertNull($this->attributes->getValue($this->device)['fixed_asset']);
    }

    public function testGetLinkToDocs(): void
    {
        $this->attributes->setValue($this->device, ['link_to_docs' => 'Some link to docs']);
        $this->assertEquals(
            'Some link to docs',
            $this->device->getLinkToDocs()
        );

        $this->attributes->setValue($this->device, ['link_to_docs' => null]);
        $this->assertNull($this->device->getLinkToDocs());
    }

    public function testSetLinkToDocs(): void
    {
        $this->device->setLinkToDocs('Some other link to docs');
        $this->assertEquals(
            'Some other link to docs',
            $this->attributes->getValue($this->device)['link_to_docs']
        );

        $this->device->setLinkToDocs(null);
        $this->assertNull($this->attributes->getValue($this->device)['link_to_docs']);
    }

    public function testGetRackId(): void
    {
        $this->attributes->setValue($this->device, ['rack_id' => 12]);
        $this->assertEquals(
            12,
            $this->device->getRackId()
        );

        $this->attributes->setValue($this->device, ['rack_id' => null]);
        $this->assertNull($this->device->getRackId());
    }

    public function testSetRackId(): void
    {
        $this->device->setRackId(14);
        $this->assertEquals(
            14,
            $this->attributes->getValue($this->device)['rack_id']
        );

        $this->device->setRackId(null);
        $this->assertNull($this->attributes->getValue($this->device)['rack_id']);

        try {
            $this->device->setRackId(-11);
        } catch (\DomainException $e) {
            $this->assertEquals('$rackId <= 0', $e->getMessage());
        }

        try {
            $this->device->setRackId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$rackId <= 0', $e->getMessage());
        }
    }

    public function testGetDepartmentId(): void
    {
        $this->attributes->setValue($this->device, ['department_id' => 18]);
        $this->assertEquals(
            18,
            $this->device->getDepartmentId()
        );

        $this->attributes->setValue($this->device, ['department_id' => null]);
        $this->assertNull($this->device->getDepartmentId());
    }

    public function testSetDepartmentId(): void
    {
        $this->device->setDepartmentId(11);
        $this->assertEquals(
            11,
            $this->attributes->getValue($this->device)['department_id']
        );

        $this->device->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->device)['department_id']);

        try {
            $this->device->setDepartmentId(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }

        try {
            $this->device->setDepartmentId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }
    }

    public function testGetLocation(): void
    {
        $this->attributes->setValue($this->device, ['has_backside_location' => true]);
        $this->assertTrue($this->device->getLocation());

        $this->attributes->setValue($this->device, ['has_backside_location' => false]);
        $this->assertFalse($this->device->getLocation());

        $this->device->setLocation(null);
        $this->assertNull($this->attributes->getValue($this->device)['has_backside_location']);
    }

    public function testSetLocation(): void
    {
        $this->device->setLocation(true);
        $this->assertTrue($this->attributes->getValue($this->device)['has_backside_location']);

        $this->device->setLocation(false);
        $this->assertFalse($this->attributes->getValue($this->device)['has_backside_location']);

        $this->device->setLocation(null);
        $this->assertNull($this->attributes->getValue($this->device)['has_backside_location']);
    }

    public function testGetUpdatedBy(): void
    {
        $this->attributes->setValue($this->device, ['updated_by' => 'Some user']);
        $this->assertEquals(
            'Some user',
            $this->device->getUpdatedBy()
        );
    }

    public function testSetUpdatedBy(): void
    {
        $this->device->setUpdatedBy('Some other user');
        $this->assertEquals(
            'Some other user',
            $this->attributes->getValue($this->device)['updated_by']
        );
    }

    public function testGetCreatedAt(): void
    {
        $this->attributes->setValue($this->device, ['created_at' => '2024-01-28 16:37:29']);
        $this->assertEquals(
            '2024-01-28 16:37:29',
            $this->device->getCreatedAt()
        );
    }

    public function testGetUpdatedAt(): void
    {
        $this->attributes->setValue($this->device, ['updated_at' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->device->getUpdatedAt()
        );
    }
}
