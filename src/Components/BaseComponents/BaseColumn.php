<?php

namespace BoredProgrammers\LaraGrid\Components\BaseComponents;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

abstract class BaseColumn extends BaseLaraGridComponent
{

    public abstract function defaultRender(Model $model);

    protected string $label;

    /** @var callable */
    protected $renderer;

    /** @var callable */
    protected $attributes;

    protected string $columnTag = 'span';

    public function __construct(?string $label = null)
    {
        $this->setLabel($label);
        $this->setRenderer([$this, 'defaultRender']);
        $this->setAttributes(function (Model $model) {
            return [];
        });
    }

    public function callRenderer(Model $model)
    {
        return call_user_func_array($this->getRenderer(), [$model]);
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

    public function callAttributes(Model $model)
    {
        return collect(call_user_func_array($this->getAttributes(), [$model]))
            ->map(function ($value, $key) {
                return Str::of($key)->append('="', $value, '"');
            })
            ->join(' ');
    }

    public function getAttributes(): callable
    {
        return $this->attributes;
    }

    public function setAttributes(callable|string $attributes): static
    {
        if (is_string($attributes)) {
            $attributes = fn() => $attributes;
        }

        $this->attributes = $attributes;

        return $this;
    }

    public function getColumnTag(): string
    {
        return $this->columnTag;
    }

    public function setColumnTag(string $columnTag): static
    {
        $this->columnTag = $columnTag;

        return $this;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

}
