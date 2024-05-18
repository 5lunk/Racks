<?php

declare(strict_types=1);

namespace App\Enums;

enum RackPlaceTypeEnum: string
{
    case FLOOR = 'Floor standing';
    case WALL = 'Wall mounted';
}
