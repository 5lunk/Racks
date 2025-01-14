<?php

declare(strict_types=1);

namespace App\Enums;

enum RoomFireSuppressionSystemEnum: string
{
    case CENTRALIZED = 'Centralized';
    case INDIVIDUAL = 'Individual';
    case NONE = 'None';
    case ALARM_ONLY = 'Alarm only';
}
