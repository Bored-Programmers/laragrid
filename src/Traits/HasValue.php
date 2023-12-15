<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasValue
{

    private mixed $value = null;

    public function getValue(): mixed
    {
        return $this->value;
    }

    public function setValue(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }

}