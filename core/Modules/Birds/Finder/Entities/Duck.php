<?php

namespace App\Lake\Modules\Birds\Finder\Entities;

class Duck
{
    private int $quantity;

    public function __construct(int $quantity)
    {
        $this->quantity = $quantity;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}
