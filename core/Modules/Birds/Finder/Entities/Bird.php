<?php

namespace App\Lake\Modules\Birds\Finder\Entities;

class Bird
{
    private $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
