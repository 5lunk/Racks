<?php

declare(strict_types=1);

namespace Tests\Unit\Models\HelperObjects;

use App\Models\HelperObjects\SiteAttributesHelperObject;
use App\Models\Site;
use Tests\TestCase;

class SiteAttributesValueObjectTest extends TestCase
{
    public function testSetName(): void
    {
        // Attr not null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getName')
            ->willReturn('some name');

        $attrsMock = $this->getMockBuilder(SiteAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesHelperObject::class);
        $method = $reflection->getMethod('setName');
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['name' => 'some name'],
            $attributesForSiteProp->getValue($attrsMock)
        );

        // Attr is null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getName')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(SiteAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesHelperObject::class);
        $method = $reflection->getMethod('setName');
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForSiteProp->getValue($attrsMock)
        );
    }

    public function testSetUpdatedBy(): void
    {
        // Attr not null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn('user');

        $attrsMock = $this->getMockBuilder(SiteAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesHelperObject::class);
        $method = $reflection->getMethod('setUpdatedBy');
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['updated_by' => 'user'],
            $attributesForSiteProp->getValue($attrsMock)
        );

        // Attr is null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(SiteAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesHelperObject::class);
        $method = $reflection->getMethod('setUpdatedBy');
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForSiteProp->getValue($attrsMock)
        );
    }

    public function testSetDescription(): void
    {
        // Attr not null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getDescription')
            ->willReturn('description');

        $attrsMock = $this->getMockBuilder(SiteAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesHelperObject::class);
        $method = $reflection->getMethod('setDescription');
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['description' => 'description'],
            $attributesForSiteProp->getValue($attrsMock)
        );

        // Attr is null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getDescription')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(SiteAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesHelperObject::class);
        $method = $reflection->getMethod('setDescription');
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForSiteProp->getValue($attrsMock)
        );
    }

    public function testSetDepartmentId(): void
    {
        // Attr not null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(7);

        $attrsMock = $this->getMockBuilder(SiteAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesHelperObject::class);
        $method = $reflection->getMethod('setDepartmentId');
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['department_id' => 7],
            $attributesForSiteProp->getValue($attrsMock)
        );

        // Attr is null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(SiteAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesHelperObject::class);
        $method = $reflection->getMethod('setDepartmentId');
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForSiteProp->getValue($attrsMock)
        );
    }

    public function testToArray(): void
    {
        $attrsMock = $this->getMockBuilder(SiteAttributesHelperObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesHelperObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');

        $attributesForSiteProp->setValue($attrsMock, ['oops' => 'oops']);
        $this->assertEquals(
            $attrsMock->toArray(),
            $attributesForSiteProp->getValue($attrsMock)
        );
    }

    public function testConstructor(): void
    {
        $site = new Site([
            'name' => 'name',
            'description' => 'description',
            'updated_by' => 'user',
            'department_id' => 1,
        ]);
        $siteAttrsValueObj = new SiteAttributesHelperObject($site);
        $this->assertEquals(
            [
                'name' => 'name',
                'description' => 'description',
                'updated_by' => 'user',
                'department_id' => 1,
            ],
            $siteAttrsValueObj->toArray()
        );

        $site = new Site([
            'name' => 'name',
            'description' => null,
            'updated_by' => 'user',
            'department_id' => 1,
        ]);
        $siteAttrsValueObj = new SiteAttributesHelperObject($site);
        $this->assertEquals(
            [
                'name' => 'name',
                'updated_by' => 'user',
                'department_id' => 1,
            ],
            $siteAttrsValueObj->toArray()
        );
    }
}
