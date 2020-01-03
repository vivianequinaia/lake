<?php

namespace App\Repositories;

use App\Lake\Modules\Birds\Finder\Entities\Bird;
use App\Lake\Modules\Birds\Finder\Exceptions\FindBirdsDatabaseException;
use App\Lake\Modules\Birds\Finder\Gateways\FindBirdsGateway;
use App\Lake\Modules\Birds\Finder\Requests\Request;

class BirdRepository implements FindBirdsGateway
{
    private $birds;

    public function __construct()
    {
        $this->birds = new \App\Entities\Bird();
    }

    public function findBirds(Request $request): Bird
    {
        try {
            $birds = $this->birds->getAll();
            $count = 0;
            if ($request->getColor() == 'yellow') {
                foreach ($birds as $bird) {
                    if ($bird['color'] == 'yellow' && $bird['is_duck']) {
                        $count++;
                    }
                }
                return new Bird($count);
            }

            foreach ($birds as $bird) {
                if (!$bird['is_duck']) {
                    $count++;
                }
            }
            return new Bird($count);
        } catch (\Exception $exception) {
            throw new FindBirdsDatabaseException();
        }
    }
}
