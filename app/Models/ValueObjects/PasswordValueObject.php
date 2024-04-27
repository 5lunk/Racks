<?php

declare(strict_types=1);

namespace App\Models\ValueObjects;

use App\Domain\Interfaces\UserInterfaces\PasswordInterface;
use Illuminate\Support\Facades\Hash;

/**
 * User password value object
 * with hashing and validation
 */
class PasswordValueObject implements PasswordInterface
{
    /**
     * @const string
     */
    public const VALIDATION_REGEX = "/\w{6,}/";

    /**
     * @var string
     */
    private string $password;

    /**
     * @param  string  $password
     *
     * @throws \DomainException Invalid password
     */
    public function __construct(string $password)
    {
        if ($this->isHashed($password)) {
            $this->password = $password;
        } else {
            if (! $this->validate($password)) {
                throw new \DomainException('Invalid password');
            }
            $this->password = Hash::make($password);
        }
    }

    /**
     * @param  string  $password
     * @return bool
     */
    public function validate(string $password): bool
    {
        if (! filter_var($password, FILTER_VALIDATE_REGEXP, ['options' => ['regexp' => self::VALIDATION_REGEX]])) {
            return false;
        }

        return true;
    }

    /**
     * @param  string  $password
     * @return bool
     */
    public function isHashed(string $password): bool
    {
        $info = Hash::info($password);
        if (isset($info['algo'])) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->password;
    }
}
