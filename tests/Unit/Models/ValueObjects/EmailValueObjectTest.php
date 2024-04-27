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
}
