<?php

namespace App\Repositories;

use App\Lake\Modules\Birds\Finder\Entities\Duck;
use App\Lake\Modules\Birds\Finder\Exceptions\CountDucksDatabaseException;
use App\Lake\Modules\Birds\Finder\Gateways\DucksInterface;

class NotIsADuckRepository implements DucksInterface
{
    private $ducks;

    public function __construct()
    {
        $this->ducks = new \App\Entities\Duck();
    }

    public function countDucks(): Duck
    {
        try {
            $ducks = $this->ducks->getAll();
            $count = 0;

            foreach ($ducks as $duck) {
                if (!$duck['is_duck']) {
                    $count++;
                }
            }
            return new Duck($count);
        } catch (\Exception $exception) {
            throw new CountDucksDatabaseException();
        }
    }
}
