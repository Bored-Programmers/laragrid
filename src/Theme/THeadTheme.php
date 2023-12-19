<?php

namespace BoredProgrammers\LaraGrid\Theme;

class THeadTheme
{

    private ?string $theadClass = null;

    private ?string $trClass = null;

    private ?string $thClass = null;

    public function __construct()
    {
    }

    public static function make(): static
    {
        return new static();
    }

    public function getTheadClass(): ?string
    {
        return $this->theadClass;
    }

    public function setTheadClass(?string $theadClass): static
    {
        $this->theadClass = $theadClass;

        return $this;
    }

    public function getTrClass(): ?string
    {
        return $this->trClass;
    }

    public function setTrClass(?string $trClass): static
    {
        $this->trClass = $trClass;

        return $this;
    }

    public function getThClass(): ?string
    {
        return $this->thClass;
    }

    public function setThClass(?string $thClass): static
    {
        $this->thClass = $thClass;

        return $this;
    }

}