<?php

declare(strict_types=1);

namespace App\Domain\Interfaces\UserInterfaces;

use App\Models\ValueObjects\EmailValueObject;

interface EmailInterface
{
    /**
     * @param  EmailValueObject  $emailObject
     * @return bool
     */
    public function equalTo(EmailValueObject $emailObject): bool;
}
