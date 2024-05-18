<?php

declare(strict_types=1);

namespace Tests\Unit\Models\Traits;

use App\Models\Traits\UniqueNameableTrait;
use PHPUnit\Framework\TestCase;

class UniqueNameableTraitTest extends TestCase
{
    use UniqueNameableTrait;

    public function testIsNameValid(): void
    {
        $namesList = ['first', 'second', 'third'];
        self::assertTrue($this->isNameValid('some_name', $namesList));
        self::assertFalse($this->isNameValid('first', $namesList));
        self::assertTrue($this->isNameValid(null, $namesList));
    }
}
