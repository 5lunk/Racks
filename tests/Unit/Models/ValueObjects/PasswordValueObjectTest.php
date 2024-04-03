<?php

namespace Tests\Unit\Models\ValueObjects;

use App\Models\ValueObjects\PasswordValueObject;
use Tests\TestCase;

class PasswordValueObjectTest extends TestCase
{
    public function testConstructor(): void
    {
        try {
            $pass1 = new PasswordValueObject('pass');
        } catch (\DomainException $e) {
            $this->assertEquals('Invalid password', $e->getMessage());
        }

        $pass2 = new PasswordValueObject('$2y$04$RsdQnG8HrdWZ16VuAJx3S.5y4z3jkUc3m7phXYJ1z/6lVKXZSjpGC');
        $this->assertEquals(
            '$2y$04$RsdQnG8HrdWZ16VuAJx3S.5y4z3jkUc3m7phXYJ1z/6lVKXZSjpGC',
            (string) $pass2
        );
    }

    public function testValidate(): void
    {
        $pass = new PasswordValueObject('passw_000rd');
        $this->assertFalse($pass->validate('r2d2'));
        $this->assertTrue($pass->validate('SoMe_valid_passw00rD'));
    }

    public function testIsHashed(): void
    {
        $pass = new PasswordValueObject('SoMe_valid_passw00rD');
        $this->assertFalse($pass->isHashed('r2d2'));
        $this->assertTrue($pass->isHashed('$2y$04$RsdQnG8HrdWZ16VuAJx3S.5y4z3jkUc3m7phXYJ1z/6lVKXZSjpGC'));
    }

    public function testToString(): void
    {

        $passMock = $this->getMockBuilder(PasswordValueObject::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(PasswordValueObject::class);
        $password = $reflection->getProperty('password');

        $password->setValue($passMock, '$2y$04$RsdQnG8HrdWZ16VuAJx3S.5y4z3jkUc3m7phXYJ1z/6lVKXZSjpGC');
        $this->assertEquals(
            '$2y$04$RsdQnG8HrdWZ16VuAJx3S.5y4z3jkUc3m7phXYJ1z/6lVKXZSjpGC',
            (string) $passMock
        );
    }
}
