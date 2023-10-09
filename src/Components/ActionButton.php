<?php

namespace BoredProgrammers\LaraGrid\Components;

class ActionButton
{

    protected string $route;

    protected string $label;

    protected string $icon;

    protected string $class;

    public function __construct()
    {
    }

    public static function make(): self
    {
        return new static();
    }

    public function getRoute(): string
    {
        return $this->route;
    }

    public function setRoute(string $route): ActionButton
    {
        $this->route = $route;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): ActionButton
    {
        $this->label = $label;

        return $this;
    }

}
