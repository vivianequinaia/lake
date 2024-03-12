<?php

namespace App\Lake\Modules\Birds\Finder\Enums;

use Core\Modules\Generics\Enums\Interfaces\CodeErrorNameEnum;

enum ErrorCodeEnum
{
    const BIRDS__FINDER__GENERIC_EXCEPTION = 'A generic error occured.';
    const BIRDS__FINDER__DUCKS_DATABASE_EXCEPTION = 'A error occurred when trying to count the ducks.';
}
