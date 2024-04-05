<?php

namespace Tests\Unit\Models;

use App\Models\Site;
use App\Models\ValueObjects\SiteAttributesValueObject;
use Tests\TestCase;

class SiteTest extends TestCase
{
    public $site; // @phpstan-ignore-line

    public $attributes; // @phpstan-ignore-line

    public function setUp(): void
    {
        parent::setUp();

        $this->site = $this->getMockBuilder(Site::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(Site::class);
        $this->attributes = $reflection->getProperty('attributes');
    }

    public function testGetId(): void
    {
        $this->attributes->setValue($this->site, ['id' => 5]);
        $this->assertEquals(
            5,
            $this->site->getId()
        );
    }

    public function testGetName(): void
    {
        $this->attributes->setValue($this->site, ['name' => 'test name']);
        $this->assertEquals(
            'test name',
            $this->site->getName()
        );

        $this->site->setName(null);
        $this->assertNull($this->attributes->getValue($this->site)['name']);
    }

    public function testSetName(): void
    {
        $this->site->setName('name');
        $this->assertEquals(
            'name',
            $this->attributes->getValue($this->site)['name']
        );

        $this->site->setName(null);
        $this->assertNull($this->attributes->getValue($this->site)['name']);
    }

    public function testGetDescription(): void
    {
        $this->attributes->setValue($this->site, ['description' => 'some description']);
        $this->assertEquals(
            'some description',
            $this->site->getDescription()
        );

        $this->site->setDescription(null);
        $this->assertNull($this->attributes->getValue($this->site)['description']);
    }

    public function testSetDescription(): void
    {
        $this->site->setDescription('description');
        $this->assertEquals(
            'description',
            $this->attributes->getValue($this->site)['description']
        );

        $this->site->setDescription(null);
        $this->assertNull($this->attributes->getValue($this->site)['description']);
    }

    public function testGetUpdatedBy(): void
    {
        $this->attributes->setValue($this->site, ['updated_by' => 'tester']);
        $this->assertEquals(
            'tester',
            $this->site->getUpdatedBy()
        );

        $this->site->setUpdatedBy(null);
        $this->assertNull($this->attributes->getValue($this->site)['updated_by']);
    }

    public function testSetUpdatedBy(): void
    {
        $this->site->setUpdatedBy('user');
        $this->assertEquals(
            'user',
            $this->attributes->getValue($this->site)['updated_by']
        );

        $this->site->setUpdatedBy(null);
        $this->assertNull($this->attributes->getValue($this->site)['updated_by']);
    }

    public function testSetDepartmentId(): void
    {
        $this->site->setDepartmentId(4);
        $this->assertEquals(
            4,
            $this->attributes->getValue($this->site)['department_id']
        );

        $this->site->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->site)['department_id']);

        try {
            $this->site->setDepartmentId(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }

        try {
            $this->site->setDepartmentId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }
    }

    public function testGetDepartmentId(): void
    {
        $this->attributes->setValue($this->site, ['department_id' => 1]);
        $this->assertEquals(
            1,
            $this->site->getDepartmentId()
        );

        $this->site->setDepartmentId(null);
        $this->assertNull($this->attributes->getValue($this->site)['department_id']);
    }

    public function testGetCreatedAt(): void
    {
        $this->attributes->setValue($this->site, ['created_at' => '2024-01-28 16:37:29']);
        $this->assertEquals(
            '2024-01-28 16:37:29',
            $this->site->getCreatedAt()
        );
    }

    public function testGetUpdatedAt(): void
    {
        $this->attributes->setValue($this->site, ['updated_at' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->site->getUpdatedAt()
        );
    }

    public function testGetAttributeSet(): void
    {
        $attrsValObjMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->app->bind(SiteAttributesValueObject::class, function () use ($attrsValObjMock) {
            return $attrsValObjMock;
        });

        $this->assertSame(
            $attrsValObjMock,
            $this->site->getAttributeSet(),
        );

        $this->app->offsetUnset(SiteAttributesValueObject::class);
    }
}
