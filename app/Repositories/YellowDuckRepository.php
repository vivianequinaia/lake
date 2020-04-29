<?php

namespace App\Repositories;

use App\Lake\Modules\Birds\Finder\Entities\Duck;
use App\Lake\Modules\Birds\Finder\Exceptions\CountDucksDatabaseException;
use App\Lake\Modules\Birds\Finder\Gateways\CountDucksGateway;
use App\Lake\Modules\Birds\Finder\Requests\Request;

class YellowDuckRepository implements CountDucksGateway
{
    private $birds;

    public function __construct()
    {
        $this->birds = new \App\Entities\Duck();
    }

    public function countDucks(): Duck
    {
        try {
            $birds = $this->birds->getAll();
            $count = 0;
            foreach ($birds as $bird) {
                if ($bird['color'] == 'yellow' && $bird['is_duck']) {
                    $count++;
                }
            }

            return new Duck($count);
        } catch (\Exception $exception) {
            throw new CountDucksDatabaseException();
        }
    }
}
