<?php

declare(strict_types=1);

namespace Tests\Unit\Models\HelperObjects;

use App\Models\Building;
use App\Models\HelperObjects\BuildingAttributesHelperObject;
use Tests\TestCase;

class BuildingAttributesValueObjectTest extends TestCase
{
    public function testSetName(): void
    {
        // Attr not null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getName')
            ->willReturn('some name');

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setName');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['name' => 'some name'],
            $attributesForBuildingProp->getValue($attrsMock)
        );

        // Attr is null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getName')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setName');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForBuildingProp->getValue($attrsMock)
        );
    }

    public function testSetId(): void
    {
        // Attr not null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getSiteId')
            ->willReturn(12);

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setSiteId');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['site_id' => 12],
            $attributesForBuildingProp->getValue($attrsMock)
        );

        // Attr is null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getSiteId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setSiteId');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForBuildingProp->getValue($attrsMock)
        );
    }

    public function testSetUpdatedBy(): void
    {
        // Attr not null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn('user');

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setUpdatedBy');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['updated_by' => 'user'],
            $attributesForBuildingProp->getValue($attrsMock)
        );

        // Attr is null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setUpdatedBy');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForBuildingProp->getValue($attrsMock)
        );
    }

    public function testSetDescription(): void
    {
        // Attr not null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getDescription')
            ->willReturn('description');

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setDescription');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['description' => 'description'],
            $attributesForBuildingProp->getValue($attrsMock)
        );

        // Attr is null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getDescription')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setDescription');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForBuildingProp->getValue($attrsMock)
        );
    }

    public function testSetDepartmentId(): void
    {
        // Attr not null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(5);

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setDepartmentId');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['department_id' => 5],
            $attributesForBuildingProp->getValue($attrsMock)
        );

        // Attr is null
        $buildingMock = $this->createMock(Building::class);
        $buildingMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $method = $reflection->getMethod('setDepartmentId');
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');
        $buildingProp = $reflection->getProperty('building');
        $buildingProp->setValue($attrsMock, $buildingMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForBuildingProp->getValue($attrsMock)
        );
    }

    public function testToArray(): void
    {
        $attrsMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(BuildingAttributesHelperObject::class);
        $attributesForBuildingProp = $reflection->getProperty('attributesForBuilding');

        $attributesForBuildingProp->setValue($attrsMock, ['oops' => 'oops']);
        $this->assertEquals(
            $attrsMock->toArray(),
            $attributesForBuildingProp->getValue($attrsMock)
        );
    }

    public function testConstructor(): void
    {
        $building = new Building([
            'name' => 'name',
            'description' => 'description',
            'updated_by' => 'user',
            'site_id' => 2,
            'department_id' => 1,
        ]);
        $buildingAttrsValueObj = new BuildingAttributesHelperObject($building);
        $this->assertEquals(
            [
                'name' => 'name',
                'description' => 'description',
                'updated_by' => 'user',
                'site_id' => 2,
                'department_id' => 1,
            ],
            $buildingAttrsValueObj->toArray()
        );

        $building = new Building([
            'name' => 'name',
            'description' => null,
            'updated_by' => 'user',
            'site_id' => 2,
            'department_id' => 1,
        ]);
        $buildingAttrsValueObj = new BuildingAttributesHelperObject($building);
        $this->assertEquals(
            [
                'name' => 'name',
                'updated_by' => 'user',
                'site_id' => 2,
                'department_id' => 1,
            ],
            $buildingAttrsValueObj->toArray()
        );
    }
}
