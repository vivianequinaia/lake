<?php

namespace App\Lake\Modules\Birds\Finder\Builders;

use App\Lake\Modules\Birds\Finder\Responses\Response;
use App\Lake\Modules\Birds\Finder\Responses\Status;
use App\Lake\Modules\Birds\Finder\Rules\CountDucksRule;

class Builder
{
    private $countDucksRule;

    public function withCountDucksRule(CountDucksRule $countDucksRule): Builder
    {
        $this->countDucksRule = $countDucksRule;
        return $this;
    }

    public function build(): Response
    {
        return new Response(
            new Status(200, 'Ok'),
            $this->countDucksRule->apply()
        );
    }
}
