<?php

declare(strict_types=1);

namespace App\Models\Enums;

enum RackFrameEnum: string
{
    case SINGLE = 'Single frame';
    case DOUBLE = 'Double frame';
}
