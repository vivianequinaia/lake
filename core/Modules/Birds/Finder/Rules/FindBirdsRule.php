<?php

namespace App\Lake\Modules\Birds\Finder\Rules;

use App\Lake\Modules\Birds\Finder\Entities\Bird;
use App\Lake\Modules\Birds\Finder\Gateways\FindBirdsGateway;
use App\Lake\Modules\Birds\Finder\Requests\Request;

class FindBirdsRule
{
    private $findBirdsGateway;
    private $request;

    public function __construct(FindBirdsGateway $findBirdsGateway, Request $request)
    {
        $this->findBirdsGateway = $findBirdsGateway;
        $this->request = $request;
    }

    public function apply(): Bird
    {
        return $this->findBirdsGateway->findBirds($this->request);
    }
}
