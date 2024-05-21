<?php

declare(strict_types=1);

namespace App\Models\ValueObjects;

use App\Domain\Interfaces\UserInterfaces\EmailInterface;

/**
 * Email value object
 * with simple validation
 */
class EmailValueObject implements EmailInterface
{
    /**
     * @var string
     */
    private readonly string $email;

    /**
     * @param  string  $email
     *
     * @throws \DomainException Invalid email
     */
    public function __construct(string $email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \DomainException("Invalid email '{$email}'");
        }
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->email;
    }

    /**
     * @param  EmailValueObject  $emailObject
     * @return bool
     */
    public function equalTo(EmailValueObject $emailObject): bool
    {
        return $this->email === (string) $emailObject;
    }
}
