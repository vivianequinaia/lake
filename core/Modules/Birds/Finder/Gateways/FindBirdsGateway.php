<?php

namespace App\Lake\Modules\Birds\Finder\Gateways;

use App\Lake\Modules\Birds\Finder\Entities\Bird;
use App\Lake\Modules\Birds\Finder\Requests\Request;

interface FindBirdsGateway
{
    public function findBirds(Request $request): Bird;
}
