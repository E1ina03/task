<?php

declare(strict_types=1);

namespace App\Models;

enum EnumForEnable:int
{
    case DISABLED = 0;
    case ENABLED = 1;
}
