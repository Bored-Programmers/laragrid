<?php

namespace BoredProgrammers\LaraGrid\Traits;

trait HasHeader
{

    /** @var callable */
    private $header;

    public function callHeader(...$args)
    {
        return call_user_func_array($this->getHeader(), $args);
    }

    public function getHeader(): callable
    {
        return $this->header;
    }

    public function setHeader(callable|string $header): static
    {
        if (is_string($header)) {
            $header = fn() => $header;
        }

        $this->header = $header;

        return $this;
    }

}