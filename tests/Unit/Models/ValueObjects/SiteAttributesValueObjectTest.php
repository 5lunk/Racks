<?php

namespace Tests\Unit\Models\ValueObjects;

use App\Models\Site;
use App\Models\ValueObjects\SiteAttributesValueObject;
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

        $attrsMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesValueObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $attrsMock->setName();
        $this->assertEquals(
            ['name' => 'some name'],
            $attributesForSiteProp->getValue($attrsMock)
        );

        // Attr is null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getName')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesValueObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $attrsMock->setName();
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

        $attrsMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesValueObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $attrsMock->setUpdatedBy();
        $this->assertEquals(
            ['updated_by' => 'user'],
            $attributesForSiteProp->getValue($attrsMock)
        );

        // Attr is null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesValueObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $attrsMock->setUpdatedBy();
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

        $attrsMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesValueObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $attrsMock->setDescription();
        $this->assertEquals(
            ['description' => 'description'],
            $attributesForSiteProp->getValue($attrsMock)
        );

        // Attr is null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getDescription')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesValueObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $attrsMock->setDescription();
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

        $attrsMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesValueObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $attrsMock->setDepartmentId();
        $this->assertEquals(
            ['department_id' => 7],
            $attributesForSiteProp->getValue($attrsMock)
        );

        // Attr is null
        $siteMock = $this->createMock(Site::class);
        $siteMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesValueObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');
        $siteProp = $reflection->getProperty('site');
        $siteProp->setValue($attrsMock, $siteMock);

        $attrsMock->setDepartmentId();
        $this->assertEquals(
            [],
            $attributesForSiteProp->getValue($attrsMock)
        );
    }

    public function testToArray(): void
    {
        $attrsMock = $this->getMockBuilder(SiteAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(SiteAttributesValueObject::class);
        $attributesForSiteProp = $reflection->getProperty('attributesForSite');

        $attributesForSiteProp->setValue($attrsMock, ['oops' => 'oops']);
        $this->assertEquals(
            $attrsMock->toArray(),
            $attributesForSiteProp->getValue($attrsMock)
        );
    }

    public function testConstructor()
    {
        $site = new Site([
            'name' => 'name',
            'description' => 'description',
            'updated_by' => 'user',
            'department_id' => 1,
        ]);
        $siteAttrsValueObj = new SiteAttributesValueObject($site);
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
        $siteAttrsValueObj = new SiteAttributesValueObject($site);
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
