<?php

declare(strict_types=1);

namespace App\Models\Enums;

enum DevicePowerACDCEnum: string
{
    case AC = 'AC';
    case DC = 'DC';
}
