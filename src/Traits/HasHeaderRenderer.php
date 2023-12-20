<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasHeaderRenderer
{

    /** @var callable */
    private $headerRenderer;

    public function callHeaderRenderer(...$args)
    {
        return call_user_func_array($this->getHeaderRenderer(), $args);
    }

    public function getHeaderRenderer(): ?callable
    {
        return $this->headerRenderer;
    }

    public function setHeaderRenderer(callable|string $headerRenderer): static
    {
        if (is_string($headerRenderer)) {
            $headerRenderer = fn() => $headerRenderer;
        }

        $this->headerRenderer = $headerRenderer;

        return $this;
    }

}