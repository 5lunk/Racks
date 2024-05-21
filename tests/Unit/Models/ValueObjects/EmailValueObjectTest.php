<?php

declare(strict_types=1);

namespace Tests\Unit\Models\ValueObjects;

use App\Models\ValueObjects\EmailValueObject;
use Tests\TestCase;

class EmailValueObjectTest extends TestCase
{
    public function testConstructor(): void
    {
        try {
            $email = new EmailValueObject('someemail');
        } catch (\DomainException $e) {
            $this->assertEquals("Invalid email 'someemail'", $e->getMessage());
        }

        try {
            $email = new EmailValueObject('testmail.com');
        } catch (\DomainException $e) {
            $this->assertEquals("Invalid email 'testmail.com'", $e->getMessage());
        }

        try {
            $email = new EmailValueObject('test@mailcom');
        } catch (\DomainException $e) {
            $this->assertEquals("Invalid email 'test@mailcom'", $e->getMessage());
        }

        $this->assertEquals(
            'test@mail.com',
            (string) (new EmailValueObject('test@mail.com'))
        );
    }

    public function testToString(): void
    {
        $this->assertEquals(
            'test@mail.com',
            (new EmailValueObject('test@mail.com'))->__toString()
        );
    }

    public function testEqualTo(): void
    {
        $email1 = new EmailValueObject('test1@mail.com');
        $email2 = new EmailValueObject('test1@mail.com');
        $email3 = new EmailValueObject('test2@mail.com');

        $this->assertTrue($email1->equalTo($email2));
        $this->assertFalse($email1->equalTo($email3));
    }
}
