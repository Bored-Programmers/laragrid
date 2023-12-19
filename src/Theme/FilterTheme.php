<?php

namespace BoredProgrammers\LaraGrid\Theme;

class FilterTheme
{

    private ?string $filterTextClass = null;

    private ?string $filterSelectClass = null;

    private ?string $filterDateClass = null;

    public function __construct()
    {
    }

    public static function make(): static
    {
        return new static();
    }

    public function getFilterTextClass(): ?string
    {
        return $this->filterTextClass;
    }

    public function setFilterTextClass(?string $filterTextClass): static
    {
        $this->filterTextClass = $filterTextClass;

        return $this;
    }

    public function getFilterSelectClass(): ?string
    {
        return $this->filterSelectClass;
    }

    public function setFilterSelectClass(?string $filterSelectClass): static
    {
        $this->filterSelectClass = $filterSelectClass;

        return $this;
    }

    public function getFilterDateClass(): ?string
    {
        return $this->filterDateClass;
    }

    public function setFilterDateClass(?string $filterDateClass): static
    {
        $this->filterDateClass = $filterDateClass;

        return $this;
    }

}