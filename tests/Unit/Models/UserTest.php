<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\User;
use App\Models\ValueObjects\EmailValueObject;
use App\Models\ValueObjects\PasswordValueObject;
use Tests\TestCase;

class UserTest extends TestCase
{
    public $user; // @phpstan-ignore-line

    public $attributes; // @phpstan-ignore-line

    public function setUp(): void
    {
        parent::setUp();

        // Mock for Getters and Setters
        $this->user = $this->getMockBuilder(User::class)
            ->onlyMethods(['__construct'])
            ->disableOriginalConstructor()
            ->getMock();
        $reflection = new \ReflectionClass(User::class);
        $this->attributes = $reflection->getProperty('attributes');
    }

    public function testGetId(): void
    {
        $this->attributes->setValue($this->user, ['id' => 12]);
        $this->assertEquals(
            12,
            $this->user->getId()
        );
    }

    public function testGetName(): void
    {
        $this->attributes->setValue($this->user, ['name' => 'Some user']);
        $this->assertEquals(
            'Some user',
            $this->user->getName()
        );
    }

    public function testSetName(): void
    {
        $this->user->setName('Some other user');
        $this->assertEquals(
            'Some other user',
            $this->attributes->getValue($this->user)['name']
        );
    }

    public function testGetFullName(): void
    {
        $this->attributes->setValue($this->user, ['full_name' => 'Some user']);
        $this->assertEquals(
            'Some user',
            $this->user->getFullName()
        );
    }

    public function testSetFullName(): void
    {
        $this->user->setFullName('Some other user');
        $this->assertEquals(
            'Some other user',
            $this->attributes->getValue($this->user)['full_name']
        );
    }

    public function testGetDepartmentId(): void
    {
        $this->attributes->setValue($this->user, ['department_id' => 18]);
        $this->assertEquals(
            18,
            $this->user->getDepartmentId()
        );
    }

    public function testSetDepartmentId(): void
    {
        $this->user->setDepartmentId(11);
        $this->assertEquals(
            11,
            $this->attributes->getValue($this->user)['department_id']
        );

        try {
            $this->user->setDepartmentId(-1);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }

        try {
            $this->user->setDepartmentId(0);
        } catch (\DomainException $e) {
            $this->assertEquals('$departmentId <= 0', $e->getMessage());
        }
    }

    public function testGetEmail(): void
    {
        // Testing injected EmailValueObject via app()->make()
        $this->attributes->setValue(
            $this->user, ['email' => 'dummy']
        );

        $emailMock = $this->getMockBuilder(EmailValueObject::class)
            ->onlyMethods(['__toString'])
            ->setConstructorArgs(['test@mail.net'])
            ->getMock();

        $emailMock->method('__toString')
            ->willReturn('test@mail.net');

        $this->app->bind(EmailValueObject::class, function () use ($emailMock) {
            return $emailMock;
        });

        $this->assertEquals(
            'test@mail.net',
            (string) $this->user->getEmail(),
        );

        $this->app->offsetUnset(EmailValueObject::class);

        // $email is an instanceof EmailValueObject
        $this->attributes->setValue(
            $this->user, ['email' => $emailMock]
        );
        $this->assertSame(
            $emailMock,
            $this->user->getEmail()
        );
    }

    public function testSetEmail(): void
    {
        $emailMock = $this->createMock(EmailValueObject::class);

        $this->attributes->setValue(
            $this->user, ['email' => $emailMock]
        );

        $this->user->setEmail($emailMock);
        $this->assertSame(
            $emailMock,
            $this->attributes->getValue($this->user)['email']
        );
    }

    public function testGetPassword(): void
    {
        // Testing injected PasswordValueObject via app()->make()
        $this->attributes->setValue(
            $this->user, ['password' => 'dummy']
        );

        $passwordMock = $this->getMockBuilder(PasswordValueObject::class)
            ->onlyMethods(['__toString'])
            ->setConstructorArgs(['paSSw0rd'])
            ->getMock();

        $passwordMock->method('__toString')
            ->willReturn('paSSw0rd');

        $this->app->bind(PasswordValueObject::class, function () use ($passwordMock) {
            return $passwordMock;
        });

        $this->assertEquals(
            'paSSw0rd',
            (string) $this->user->getPassword(),
        );

        $this->app->offsetUnset(PasswordValueObject::class);

        // $password is an instanceof PasswordValueObject
        $this->attributes->setValue(
            $this->user, ['password' => $passwordMock]
        );
        $this->assertSame(
            $passwordMock,
            $this->user->getPassword()
        );
    }

    public function testSetPassword(): void
    {
        $passwordMock = $this->createMock(PasswordValueObject::class);

        $this->attributes->setValue(
            $this->user, ['password' => $passwordMock]
        );

        $this->user->setPassword($passwordMock);
        $this->assertSame(
            $passwordMock,
            $this->attributes->getValue($this->user)['password']
        );
    }
}
