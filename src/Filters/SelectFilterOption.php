<?php

namespace BoredProgrammers\LaraGrid\Filters;

use BoredProgrammers\LaraGrid\Traits\HasLabel;
use BoredProgrammers\LaraGrid\Traits\HasValue;

class SelectFilterOption
{

    use HasLabel, HasValue;

    public function __construct(mixed $value, string $label)
    {
        $this->setValue($value);
        $this->setLabel($label);
    }

    public static function make(mixed $value, string $label = null): static
    {
        return new static($value, $label ?: $value);
    }

}
