<?php

namespace App\Lake\Modules\Birds\Finder\Responses;

use App\Lake\Modules\Birds\Finder\Entities\Duck;
use App\Lake\Modules\Birds\Finder\Presenters\Responses\ResponsePresenter;

class Response implements ResponseInterface
{
    private $status;
    private $duck;

    public function __construct(Status $status, Duck $duck)
    {
        $this->status = $status;
        $this->duck = $duck;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getBirds(): Duck
    {
        return $this->duck;
    }

    public function getPresenter(): ResponsePresenter
    {
        return (new ResponsePresenter($this))->present();
    }
}
