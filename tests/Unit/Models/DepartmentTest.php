<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Department;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    public $department; // @phpstan-ignore-line

    public $attributes; // @phpstan-ignore-line

    public function setUp(): void
    {
        parent::setUp();

        $this->department = $this->getMockBuilder(Department::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(Department::class);
        $this->attributes = $reflection->getProperty('attributes');
    }

    public function testGetId(): void
    {
        $this->attributes->setValue($this->department, ['id' => 5]);
        $this->assertEquals(
            5,
            $this->department->getId()
        );
    }

    public function testGetName(): void
    {
        $this->attributes->setValue($this->department, ['name' => 'test name']);
        $this->assertEquals(
            'test name',
            $this->department->getName()
        );
    }

    public function testSetName(): void
    {
        $this->department->setName('name');
        $this->assertEquals(
            'name',
            $this->attributes->getValue($this->department)['name']
        );
    }

    public function testSetRegionId(): void
    {
        $this->department->setRegionId(4);
        $this->assertEquals(
            4,
            $this->attributes->getValue($this->department)['region_id']
        );

        $this->department->setRegionId(null);
        $this->assertNull($this->attributes->getValue($this->department)['region_id']);

        try {
            $this->department->setRegionId(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$regionId <= 0', $e->getMessage());
        }

        try {
            $this->department->setRegionId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$regionId <= 0', $e->getMessage());
        }
    }

    public function testGetRegionId(): void
    {
        $this->attributes->setValue($this->department, ['region_id' => 1]);
        $this->assertEquals(
            1,
            $this->department->getRegionId()
        );

        $this->department->setRegionId(null);
        $this->assertNull($this->attributes->getValue($this->department)['region_id']);
    }

    public function testGetCreatedAt(): void
    {
        $this->attributes->setValue($this->department, ['created_at' => '2024-01-28 16:37:29']);
        $this->assertEquals(
            '2024-01-28 16:37:29',
            $this->department->getCreatedAt()
        );
    }

    public function testGetUpdatedAt(): void
    {
        $this->attributes->setValue($this->department, ['updated_at' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->department->getUpdatedAt()
        );
    }
}
