<?php

namespace App\Lake\Modules\Birds\Finder\Responses;

use App\Lake\Modules\Birds\Finder\Entities\Bird;
use App\Lake\Modules\Birds\Finder\Presenters\Responses\ResponsePresenter;

class Response implements ResponseInterface
{
    private $status;
    private $birds;

    public function __construct(Status $status, Bird $birds)
    {
        $this->status = $status;
        $this->birds = $birds;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getBirds(): Bird
    {
        return $this->birds;
    }


    public function getPresenter(): ResponsePresenter
    {
        return (new ResponsePresenter($this))->present();
    }
}
