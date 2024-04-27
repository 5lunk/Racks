<?php

declare(strict_types=1);

namespace App\Models\Enums;

enum RackTypeEnum: string
{
    case RACK = 'Rack';
    case CABINET = 'Protective cabinet';
}
