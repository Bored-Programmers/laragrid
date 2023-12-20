<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasFooter
{

    /** @var callable */
    private $footer;

    public function callFooter(...$args)
    {
        return call_user_func_array($this->getFooter(), $args);
    }

    public function getFooter(): callable
    {
        return $this->footer;
    }

    public function setFooter(callable|string $footer): static
    {
        if (is_string($footer)) {
            $footer = fn() => $footer;
        }

        $this->footer = $footer;

        return $this;
    }

}