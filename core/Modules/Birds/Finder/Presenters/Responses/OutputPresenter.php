<?php

namespace App\Lake\Modules\Birds\Finder\Presenters\Responses;

use App\Lake\Modules\Birds\Finder\Outputs\LakeOutput;

class OutputPresenter
{
    private LakeOutput $output;
    private array $presenter;

    public function __construct(LakeOutput $output)
    {
        $this->output = $output;
    }

    public function present(): OutputPresenter
    {
        $this->presenter = [
            'status' => [
                'code' => $this->output->getStatus()->getCode(),
                'message' => $this->output->getStatus()->getMessage(),
            ],
            'quantity' => $this->output->getBirds()->getQuantity()
        ];

        return $this;
    }

    public function toArray(): array
    {
        return $this->presenter;
    }
}
