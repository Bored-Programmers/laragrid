<?php

namespace BoredProgrammers\LaraGrid\Components;

use Closure;
use Illuminate\Database\Eloquent\Model;

class ActionButton extends BaseLaraGridComponent
{

    protected ?Closure $redirect = null;

    protected string $label;

    protected Closure $renderer;

    protected ?Closure $attributes = null;

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

    public function setRedirect(Closure $redirect): static
    {
        $this->redirect = $redirect;

        return $this;
    }

    public function callRedirect($model): ?string
    {
        if ($this->redirect === null) {
            return null;
        }

        return ($this->redirect)($model);
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

    public function setAttributes(Closure $attributes): ActionButton
    {
        $this->attributes = $attributes;

        return $this;
    }

    public function callAttributes(Model $model)
    {
        if ($this->attributes === null) {
            return null;
        }

        return ($this->attributes)($model);
    }

}
