<?php

namespace App\Lake\Modules\Birds\Finder\Rulesets;

use App\Lake\Modules\Birds\Finder\Outputs\LakeOutput;
use App\Lake\Modules\Birds\Finder\Rules\CountDucksRule;
use App\Lake\Modules\Generics\Outputs\StatusOutput;
use Core\Modules\Generics\Enums\ResponseEnum;

class LakeRuleset
{
    private CountDucksRule $countDucksRule;

    public function __construct(CountDucksRule $countDucksRule)
    {
        $this->countDucksRule = $countDucksRule;
    }

    public function apply(): LakeOutput
    {
        return new LakeOutput(
            new StatusOutput(ResponseEnum::OK, 'Ok'),
            $this->countDucksRule->apply()
        );
    }
}
