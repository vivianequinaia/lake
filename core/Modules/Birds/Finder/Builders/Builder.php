<?php

namespace App\Lake\Modules\Birds\Finder\Builders;

use App\Lake\Modules\Birds\Finder\Responses\Response;
use App\Lake\Modules\Birds\Finder\Responses\Status;
use App\Lake\Modules\Birds\Finder\Rules\FindBirdsRule;

class Builder
{
    private $findBirdsRule;

    public function withFindBirdsRule(FindBirdsRule $findBirdsRule): Builder
    {
        $this->findBirdsRule = $findBirdsRule;
        return $this;
    }

    public function build(): Response
    {
        return new Response(
            new Status(200, 'Ok'),
            $this->findBirdsRule->apply()
        );
    }
}
