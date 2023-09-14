<?php

namespace App\Livewire;

class SelectOption
{

    private mixed $label;

    private mixed $value;

    public static function make(mixed $value, mixed $label = null): self
    {
        return new static($value, $label ?: $value);
    }

    public function __construct(mixed $value, mixed $label)
    {
        $this->setValue($value);
        $this->setLabel($label);
    }

    public function getLabel()
    {
        return $this->label;
    }

    public function setLabel($label): void
    {
        $this->label = $label;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setValue($value): void
    {
        $this->value = $value;
    }

}
