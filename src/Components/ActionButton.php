<?php

namespace BoredProgrammers\LaraGrid\Components;

use BoredProgrammers\LaraGrid\Theme\BaseLaraGridTheme;
use Closure;
use Illuminate\Database\Eloquent\Model;

class ActionButton extends BaseLaraGridComponent
{

    protected ?Closure $redirect = null;

    protected Closure $renderer;

    protected ?Closure $attributes = null;

    public function __construct(string|Closure $label)
    {
        if ($label instanceof Closure) {
            $this->setRenderer($label);
        } else {
            $this->setRenderer(function (Model $model, $theme) {
                return view('laragrid::components.action-button', [
                    'record' => $model,
                    'actionButton' => $this,
                    'theme' => $theme,
                ]);
            });
        }
    }

    public static function make(string|Closure $label): static
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

    public function setRenderer(Closure $renderer): static
    {
        $this->renderer = $renderer;

        return $this;
    }

    public function callRenderer(Model $model, BaseLaraGridTheme $theme)
    {
        return ($this->renderer)($model);
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
