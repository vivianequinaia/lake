<?php

namespace App\Lake\Modules\Birds\Finder\Presenters\Responses;

use App\Lake\Modules\Birds\Finder\Responses\Response;

class ResponsePresenter
{
    private $response;
    private $presenter;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function present(): ResponsePresenter
    {
        $this->presenter = [
            'status' => [
                'code' => $this->response->getStatus()->getCode(),
                'message' => $this->response->getStatus()->getMessage(),
            ],
            'quantity' => $this->response->getBirds()->getQuantity()
        ];

        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
