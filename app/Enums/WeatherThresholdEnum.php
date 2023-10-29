<?php

namespace App\Enums;

use App\Traits\EnumTrait;

enum WeatherThresholdEnum: int
{
    use EnumTrait;

    case THRESHOLD_PRESSURE = 1000;
    case THRESHOLD_UV_INDEX = 6;
}

