<?php

namespace App\Lake\Modules\Birds\Finder\Rules;

use App\Lake\Modules\Birds\Finder\Entities\Duck;
use App\Lake\Modules\Birds\Finder\Gateways\DucksInterface;

class CountDucksRule
{
    private $countDucksGateway;

    public function __construct(DucksInterface $countDucksGateway)
    {
        $this->countDucksGateway = $countDucksGateway;
    }

    public function apply(): Duck
    {
        return $this->countDucksGateway->countDucks();
    }
}
