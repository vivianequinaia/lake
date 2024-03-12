<?php

namespace App\Lake\Modules\Birds\Finder\Gateways;

use App\Lake\Modules\Birds\Finder\Entities\Duck;

interface DucksInterface
{
    public function countDucks(): Duck;
}
