<?php

namespace BoredProgrammers\LaraGrid\Components;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ActionButton extends BaseLaraGridComponent
{

    protected Closure $route;

    protected string $label;

    protected Closure $renderer;

    public function __construct(string $label, Closure $route)
    {
        $this->setLabel(__($label));
        $this->setRoute($route);
        $this->setRenderer(function (Model $model) {
            return $this->getDefaultRenderer($model);
        });
    }

    public static function make(string $label, Closure $route): self
    {
        return new static($label, $route);
    }

    public function getRoute($model): string
    {
        return ($this->route)($model);
    }

    public function setRoute(Closure $route): static
    {
        $this->route = $route;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    public function getRenderer(): Closure
    {
        return $this->renderer;
    }

    public function setRenderer(Closure $renderer): static
    {
        $this->renderer = $renderer;

        return $this;
    }

    public function callRenderer(Model $model)
    {
        return ($this->renderer)($model);
    }

    public function getDefaultRenderer(Model $model): string
    {
        return __($this->getLabel());
    }

}
