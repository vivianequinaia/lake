<?php

namespace App\Lake\Modules\Birds\Finder\Gateways;

use App\Lake\Modules\Birds\Finder\Entities\Duck;
use App\Lake\Modules\Birds\Finder\Requests\Request;

interface CountDucksGateway
{
    public function countDucks(): Duck;
}
