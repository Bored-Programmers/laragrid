<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasPrompt
{

    private ?string $prompt = 'laragrid::translations.filter.choose';

    public function getPrompt(): ?string
    {
        return $this->prompt;
    }

    public function setPrompt(?string $prompt): static
    {
        $this->prompt = $prompt;

        return $this;
    }

}