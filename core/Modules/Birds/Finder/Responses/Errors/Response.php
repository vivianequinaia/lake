<?php

namespace App\Lake\Modules\Birds\Finder\Responses\Errors;

use App\Lake\Modules\Birds\Finder\Presenters\Responses\Errors\ResponsePresenter;
use App\Lake\Modules\Birds\Finder\Responses\ResponseInterface;
use App\Lake\Modules\Birds\Finder\Responses\Status;

class Response implements ResponseInterface
{
    private $status;
    private $error;

    public function __construct(Status $status, string $error)
    {
        $this->status = $status;
        $this->error = $error;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function getError(): string
    {
        return $this->error;
    }

    public function getPresenter(): ResponsePresenter
    {
        return (new ResponsePresenter($this))->present();
    }
}
