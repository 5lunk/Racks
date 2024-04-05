<?php

namespace Tests\Unit\Models;

use App\Models\Region;
use Tests\TestCase;

class RegionTest extends TestCase
{
    public $region; // @phpstan-ignore-line

    public $attributes; // @phpstan-ignore-line

    public function setUp(): void
    {
        parent::setUp();

        $this->region = $this->getMockBuilder(Region::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(Region::class);
        $this->attributes = $reflection->getProperty('attributes');
    }

    public function testGetId(): void
    {
        $this->attributes->setValue($this->region, ['id' => 5]);
        $this->assertEquals(
            5,
            $this->region->getId()
        );
    }

    public function testGetName(): void
    {
        $this->attributes->setValue($this->region, ['name' => 'test name']);
        $this->assertEquals(
            'test name',
            $this->region->getName()
        );
    }

    public function testSetName(): void
    {
        $this->region->setName('name');
        $this->assertEquals(
            'name',
            $this->attributes->getValue($this->region)['name']
        );
    }

    public function testGetCreatedAt(): void
    {
        $this->attributes->setValue($this->region, ['created_at' => '2024-01-28 16:37:29']);
        $this->assertEquals(
            '2024-01-28 16:37:29',
            $this->region->getCreatedAt()
        );
    }

    public function testGetUpdatedAt(): void
    {
        $this->attributes->setValue($this->region, ['updated_at' => '2024-01-28 16:39:20']);
        $this->assertEquals(
            '2024-01-28 16:39:20',
            $this->region->getUpdatedAt()
        );
    }
}
