<?php

namespace App\Lake\Modules\Generics\Outputs\Interfaces;

use App\Lake\Modules\Generics\Outputs\StatusOutput;

interface OutputInterface
{
    public function getStatus(): StatusOutput;

}