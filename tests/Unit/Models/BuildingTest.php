<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Building;
use App\Models\HelperObjects\BuildingAttributesHelperObject;
use Tests\TestCase;

class BuildingTest extends TestCase
{
    public $building; // @phpstan-ignore-line

    public $attributes; // @phpstan-ignore-line

    public function setUp(): void
    {
        parent::setUp();

        $this->building = $this->getMockBuilder(Building::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(Building::class);
        $this->attributes = $reflection->getProperty('attributes');
    }

    public function testGetId(): void
    {
        $this->attributes->setValue($this->building, ['id' => 5]);
        $this->assertEquals(
            5,
            $this->building->getId()
        );
    }

    public function testGetName(): void
    {
        $this->attributes->setValue($this->building, ['name' => 'test name']);
        $this->assertEquals(
            'test name',
            $this->building->getName()
        );

        $this->building->setName(null);
        $this->assertNull($this->attributes->getValue($this->building)['name']);
    }

    public function testSetName(): void
    {
        $this->building->setName('name');
        $this->assertEquals(
            'name',
            $this->attributes->getValue($this->building)['name']
        );

        $this->building->setName(null);
        $this->assertNull($this->attributes->getValue($this->building)['name']);
    }

    public function testGetDescription(): void
    {
        $this->attributes->setValue($this->building, ['description' => 'some description']);
        $this->assertEquals(
            'some description',
            $this->building->getDescription()
        );

        $this->building->setDescription(null);
        $this->assertNull($this->attributes->getValue($this->building)['description']);
    }

    public function testSetDescription(): void
    {
        $this->building->setDescription('description');
        $this->assertEquals(
            'description',
            $this->attributes->getValue($this->building)['description']
        );

        $this->building->setDescription(null);
        $this->assertNull($this->attributes->getValue($this->building)['description']);
    }

    public function testGetUpdatedBy(): void
    {
        $this->attributes->setValue($this->building, ['updated_by' => 'tester']);
        $this->assertEquals(
            'tester',
            $this->building->getUpdatedBy()
        );

        $this->building->setUpdatedBy(null);
        $this->assertNull($this->attributes->getValue($this->building)['updated_by']);
    }

    public function testSetUpdatedBy(): void
    {
        $this->building->setUpdatedBy('user');
        $this->assertEquals(
            'user',
            $this->attributes->getValue($this->building)['updated_by']
        );

        $this->building->setUpdatedBy(null);
        $this->assertNull($this->attributes->getValue($this->building)['updated_by']);
    }

    public function testSetDepartmentId(): void
    {
        $this->building->setDepartmentId(4);
        $this->assertEquals(
            4,
            $this->attributes->getValue($this->building)['department_id']
        );

        $this->building->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->building)['department_id']);

        try {
            $this->building->setDepartmentId(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }

        try {
            $this->building->setDepartmentId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }
    }

    public function testGetDepartmentId(): void
    {
        $this->attributes->setValue($this->building, ['department_id' => 1]);
        $this->assertEquals(
            1,
            $this->building->getDepartmentId()
        );

        $this->building->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->building)['department_id']);
    }

    public function testGetSiteId(): void
    {
        $this->attributes->setValue($this->building, ['site_id' => 1]);
        $this->assertEquals(
            1,
            $this->building->getSiteId()
        );

        $this->building->setSiteId(null);
        $this->assertNull($this->attributes->getValue($this->building)['site_id']);
    }

    public function testSetSiteId(): void
    {
        $this->building->setSiteId(4);
        $this->assertEquals(
            4,
            $this->attributes->getValue($this->building)['site_id']
        );

        $this->building->setSiteId(null);
        $this->assertNull($this->attributes->getValue($this->building)['site_id']);

        try {
            $this->building->setSiteId(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$siteId <= 0', $e->getMessage());
        }

        try {
            $this->building->setSiteId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$siteId <= 0', $e->getMessage());
        }
    }

    public function testGetCreatedAt(): void
    {
        $this->attributes->setValue($this->building, ['created_at' => '2024-01-28 16:37:29']);
        $this->assertEquals(
            '2024-01-28 16:37:29',
            $this->building->getCreatedAt()
        );
    }

    public function testGetUpdatedAt(): void
    {
        $this->attributes->setValue($this->building, ['updated_at' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->building->getUpdatedAt()
        );
    }

    public function testGetAttributeSet(): void
    {
        $attrsValObjMock = $this->getMockBuilder(BuildingAttributesHelperObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->app->bind(BuildingAttributesHelperObject::class, function () use ($attrsValObjMock) {
            return $attrsValObjMock;
        });

        $this->assertSame(
            $attrsValObjMock,
            $this->building->getAttributeSet(),
        );

        $this->app->offsetUnset(BuildingAttributesHelperObject::class);
    }
}
