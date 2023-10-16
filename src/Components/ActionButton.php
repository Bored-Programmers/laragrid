<?php

namespace BoredProgrammers\LaraGrid\Components;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ActionButton extends BaseLaraGridComponent
{

    protected Closure $redirect;

    protected string $label;

    protected Closure $renderer;

    public function __construct(string $label)
    {
        $this->setLabel(__($label));
        $this->setRenderer(function (Model $model) {
            return $this->getDefaultRenderer($model);
        });
    }

    public static function make(string $label): self
    {
        return new static($label);
    }

    public function getRedirect($model): string
    {
        return ($this->redirect)($model);
    }

    public function setRedirect(Closure $redirect): static
    {
        $this->redirect = $redirect;

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
