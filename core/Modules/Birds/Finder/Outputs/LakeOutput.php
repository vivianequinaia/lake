<?php

namespace App\Lake\Modules\Birds\Finder\Outputs;

use App\Lake\Modules\Birds\Finder\Entities\Duck;
use App\Lake\Modules\Birds\Finder\Presenters\Outputs\OutputPresenter;
use App\Lake\Modules\Generics\Outputs\Interfaces\OutputInterface;
use App\Lake\Modules\Generics\Outputs\StatusOutput;

class LakeOutput implements OutputInterface
{
    private $status;
    private $duck;

    public function __construct(StatusOutput $status, Duck $duck)
    {
        $this->status = $status;
        $this->duck = $duck;
    }

    public function getStatus(): StatusOutput
    {
        return $this->status;
    }

    public function getBirds(): Duck
    {
        return $this->duck;
    }

    public function getPresenter(): OutputPresenter
    {
        return (new OutputPresenter($this))->present();
    }
}
