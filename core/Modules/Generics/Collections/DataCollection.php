<?php

namespace Core\Modules\Generics\Collections;

class DataCollection
{
    private array $collector = [];

    /**
     * @var string|int|float|bool|array|null $value
     */
    public function add(string $key, $value): self
    {
        $this->collector[$key] = $value;
        return $this;
    }

    public function all(): array
    {
        return $this->collector;
    }
}
