<?php

declare(strict_types=1);

namespace Tests\Unit\Models\ValueObjects;

use App\Models\Rack;
use App\Models\ValueObjects\RackAttributesValueObject;
use Tests\TestCase;

class RackAttributesValueObjectTest extends TestCase
{
    public function testSetName(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getName')
            ->willReturn('some name');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setName');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['name' => 'some name'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getName')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setName');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetAmount(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getAmount')
            ->willReturn(22);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setAmount');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['amount' => 22],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getAmount')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setAmount');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetVendor(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getVendor')
            ->willReturn('vendor');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setVendor');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['vendor' => 'vendor'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getVendor')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setVendor');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetUpdatedBy(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn('user');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setUpdatedBy');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['updated_by' => 'user'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getUpdatedBy')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setUpdatedBy');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetModel(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getModel')
            ->willReturn('model');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setModel');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['model' => 'model'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getModel')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setModel');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetDescription(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getDescription')
            ->willReturn('description');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setDescription');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['description' => 'description'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getDescription')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setDescription');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetHasNumberingFromTopToBottom(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getHasNumberingFromTopToBottom')
            ->willReturn(true);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setHasNumberingFromTopToBottom');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['has_numbering_from_top_to_bottom' => true],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getHasNumberingFromTopToBottom')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setHasNumberingFromTopToBottom');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetResponsible(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getResponsible')
            ->willReturn('responsible');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setResponsible');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['responsible' => 'responsible'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getResponsible')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setResponsible');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetFinanciallyResponsiblePerson(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getFinanciallyResponsiblePerson')
            ->willReturn('responsible');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setFinanciallyResponsiblePerson');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['financially_responsible_person' => 'responsible'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getFinanciallyResponsiblePerson')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setFinanciallyResponsiblePerson');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetInventoryNumber(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getInventoryNumber')
            ->willReturn('3463645745');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setInventoryNumber');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['inventory_number' => '3463645745'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getInventoryNumber')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setInventoryNumber');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetFixedAsset(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getFixedAsset')
            ->willReturn('3463645745Q');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setFixedAsset');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['fixed_asset' => '3463645745Q'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getFixedAsset')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setFixedAsset');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetLinkToDocs(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getLinkToDocs')
            ->willReturn('some link');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setLinkToDocs');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['link_to_docs' => 'some link'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getLinkToDocs')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setLinkToDocs');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetRow(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getRow')
            ->willReturn('row');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setRow');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['row' => 'row'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getRow')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setRow');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetPlace(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getPlace')
            ->willReturn('place');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setPlace');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['place' => 'place'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getPlace')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setPlace');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetHeight(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getHeight')
            ->willReturn(200);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setHeight');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['height' => 200],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getHeight')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setHeight');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetWidth(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getWidth')
            ->willReturn(200);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setWidth');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['width' => 200],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getWidth')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setWidth');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetDepth(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getDepth')
            ->willReturn(200);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setDepth');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['depth' => 200],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getDepth')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setDepth');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetUnitWidth(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getUnitWidth')
            ->willReturn(20);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setUnitWidth');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['unit_width' => 20],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getUnitWidth')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setUnitWidth');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetUnitDepth(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getUnitDepth')
            ->willReturn(20);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setUnitDepth');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['unit_depth' => 20],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getUnitDepth')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setUnitDepth');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetType(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getType')
            ->willReturn('Rack');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setType');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['type' => 'Rack'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getType')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setType');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetFrame(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getFrame')
            ->willReturn('Single frame');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setFrame');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['frame' => 'Single frame'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getFrame')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setFrame');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetPlaceType(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getPlaceType')
            ->willReturn('Wall mounted');

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setPlaceType');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['place_type' => 'Wall mounted'],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getPlaceType')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setPlaceType');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetMaxLoad(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getMaxLoad')
            ->willReturn(500);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setMaxLoad');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['max_load' => 500],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getMaxLoad')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setMaxLoad');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetPowerSockets(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getPowerSockets')
            ->willReturn(10);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerSockets');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['power_sockets' => 10],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getPowerSockets')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerSockets');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetPowerSocketsUps(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getPowerSocketsUps')
            ->willReturn(10);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerSocketsUps');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['power_sockets_ups' => 10],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getPowerSocketsUps')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setPowerSocketsUps');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetHasExternalUps(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getHasExternalUps')
            ->willReturn(true);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setHasExternalUps');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['has_external_ups' => true],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getHasExternalUps')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setHasExternalUps');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetHasCooler(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getHasCooler')
            ->willReturn(true);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setHasCooler');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['has_cooler' => true],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getHasCooler')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setHasCooler');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetDepartmentId(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(12);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setDepartmentId');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['department_id' => 12],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getDepartmentId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setDepartmentId');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testSetRoomId(): void
    {
        // Attr not null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getRoomId')
            ->willReturn(12);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setRoomId');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            ['room_id' => 12],
            $attributesForRackProp->getValue($attrsMock)
        );

        // Attr is null
        $rackMock = $this->createMock(Rack::class);
        $rackMock->expects($this->once())
            ->method('getRoomId')
            ->willReturn(null);

        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $method = $reflection->getMethod('setRoomId');
        $attributesForRackProp = $reflection->getProperty('attributesForRack');
        $rackProp = $reflection->getProperty('rack');
        $rackProp->setValue($attrsMock, $rackMock);

        $method->invoke($attrsMock);
        $this->assertEquals(
            [],
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testToArray(): void
    {
        $attrsMock = $this->getMockBuilder(RackAttributesValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(RackAttributesValueObject::class);
        $attributesForRackProp = $reflection->getProperty('attributesForRack');

        $attributesForRackProp->setValue($attrsMock, ['oops' => 'oops']);
        $this->assertEquals(
            $attrsMock->toArray(),
            $attributesForRackProp->getValue($attrsMock)
        );
    }

    public function testConstructor(): void
    {
        $rack = new Rack([
            'name' => 'some name',
            'amount' => 22,
            'vendor' => 'vendor',
            'updated_by' => 'user',
            'model' => 'model',
            'description' => 'description',
            'has_numbering_from_top_to_bottom' => true,
            'responsible' => 'responsible',
            'financially_responsible_person' => 'responsible',
            'inventory_number' => '3463645745',
            'fixed_asset' => '3463645745Q',
            'link_to_docs' => 'some link',
            'row' => 'row',
            'place' => 'place',
            'height' => 200,
            'width' => 200,
            'depth' => 200,
            'unit_width' => 20,
            'unit_depth' => 20,
            'type' => 'Rack',
            'frame' => 'Single frame',
            'place_type' => 'Wall mounted',
            'max_load' => 500,
            'power_sockets' => 10,
            'power_sockets_ups' => 10,
            'has_external_ups' => true,
            'has_cooler' => true,
            'department_id' => 12,
            'room_id' => 12,
        ]);
        $rackAttrsValueObj = new RackAttributesValueObject($rack);
        $this->assertEquals(
            [
                'name' => 'some name',
                'amount' => 22,
                'vendor' => 'vendor',
                'updated_by' => 'user',
                'model' => 'model',
                'description' => 'description',
                'has_numbering_from_top_to_bottom' => true,
                'responsible' => 'responsible',
                'financially_responsible_person' => 'responsible',
                'inventory_number' => '3463645745',
                'fixed_asset' => '3463645745Q',
                'link_to_docs' => 'some link',
                'row' => 'row',
                'place' => 'place',
                'height' => 200,
                'width' => 200,
                'depth' => 200,
                'unit_width' => 20,
                'unit_depth' => 20,
                'type' => 'Rack',
                'frame' => 'Single frame',
                'place_type' => 'Wall mounted',
                'max_load' => 500,
                'power_sockets' => 10,
                'power_sockets_ups' => 10,
                'has_external_ups' => true,
                'has_cooler' => true,
                'department_id' => 12,
                'room_id' => 12,
            ],
            $rackAttrsValueObj->toArray()
        );

        $rack = new Rack([
            'name' => 'some name',
            'amount' => 22,
            'vendor' => 'vendor',
            'updated_by' => 'user',
            'model' => 'model',
            'description' => 'description',
            'has_numbering_from_top_to_bottom' => null,
            'responsible' => 'responsible',
            'financially_responsible_person' => 'responsible',
            'inventory_number' => '3463645745',
            'fixed_asset' => '3463645745Q',
            'link_to_docs' => 'some link',
            'row' => 'row',
            'place' => 'place',
            'height' => null,
            'width' => 200,
            'depth' => 200,
            'unit_width' => 20,
            'unit_depth' => 20,
            'type' => null,
            'frame' => 'Single frame',
            'place_type' => 'Wall mounted',
            'max_load' => 500,
            'power_sockets' => 10,
            'power_sockets_ups' => 10,
            'has_external_ups' => true,
            'has_cooler' => true,
            'department_id' => 12,
            'room_id' => 12,
        ]);
        $rackAttrsValueObj = new RackAttributesValueObject($rack);
        $this->assertEquals(
            [
                'name' => 'some name',
                'amount' => 22,
                'vendor' => 'vendor',
                'updated_by' => 'user',
                'model' => 'model',
                'description' => 'description',
                'responsible' => 'responsible',
                'financially_responsible_person' => 'responsible',
                'inventory_number' => '3463645745',
                'fixed_asset' => '3463645745Q',
                'link_to_docs' => 'some link',
                'row' => 'row',
                'place' => 'place',
                'width' => 200,
                'depth' => 200,
                'unit_width' => 20,
                'unit_depth' => 20,
                'frame' => 'Single frame',
                'place_type' => 'Wall mounted',
                'max_load' => 500,
                'power_sockets' => 10,
                'power_sockets_ups' => 10,
                'has_external_ups' => true,
                'has_cooler' => true,
                'department_id' => 12,
                'room_id' => 12,
            ],
            $rackAttrsValueObj->toArray()
        );
    }
}
