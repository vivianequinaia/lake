<?php

namespace App\Lake\Modules\Birds\Finder\Requests;

class Request
{
    private $color;

    public function __construct(string $color = null)
    {
        $this->color = $color;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }
}
