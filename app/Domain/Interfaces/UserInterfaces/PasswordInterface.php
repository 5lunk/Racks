<?php

namespace App\Domain\Interfaces\UserInterfaces;

interface PasswordInterface
{
    /**
     * @param  string  $password
     * @return bool
     */
    public function validate(string $password): bool;

    /**
     * @param  string  $password
     * @return bool
     */
    public function isHashed(string $password): bool;
}
