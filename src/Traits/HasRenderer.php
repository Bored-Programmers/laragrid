<?php

namespace BoredProgrammers\LaraGrid\Traits;

use Illuminate\Database\Eloquent\Model;

trait HasRenderer
{

    /** @var callable */
    private $renderer;

    public function bootHasRenderer()
    {
        $this->setRenderer([$this, 'defaultRender']);
    }

    public function callRenderer(...$args)
    {
        return call_user_func_array($this->getRenderer(), $args);
    }

    public function getRenderer(): callable
    {
        return $this->renderer;
    }

    public function setRenderer(callable|string $renderer): static
    {
        if (is_string($renderer)) {
            $renderer = fn() => $renderer;
        }

        $this->renderer = $renderer;

        return $this;
    }

}