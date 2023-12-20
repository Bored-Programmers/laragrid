<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasFooterRenderer
{

    /** @var callable */
    private $footerRenderer;

    public function callFooterRenderer(...$args)
    {
        return call_user_func_array($this->getFooterRenderer(), $args);
    }

    public function getFooterRenderer(): callable
    {
        return $this->footerRenderer;
    }

    public function setFooterRenderer(callable|string $footerRenderer): static
    {
        if (is_string($footerRenderer)) {
            $footerRenderer = fn() => $footerRenderer;
        }

        $this->footerRenderer = $footerRenderer;

        return $this;
    }

}