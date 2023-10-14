<?php

namespace BoredProgrammers\LaraGrid\Filters;

class SelectFilterOption
{

    private mixed $label;

    private mixed $value;

    public function __construct(mixed $value, mixed $label)
    {
        $this->setValue($value);
        $this->setLabel($label);
    }

    public static function make(mixed $value, mixed $label = null): static
    {
        return new static($value, $label ?: $value);
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): static
    {
        $this->value = $value;

        return $this;
    }

}
