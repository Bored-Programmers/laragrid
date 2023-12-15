<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasLabel
{

    private ?string $label = null;

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): void
    {
        $this->label = $label;
    }

}