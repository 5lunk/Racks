<?php

declare(strict_types=1);

namespace App\Enums;

enum RoomCoolingSystemEnum: string
{
    case CENTRALIZED = 'Centralized';
    case INDIVIDUAL = 'Individual';
    case NONE = 'None';
}
