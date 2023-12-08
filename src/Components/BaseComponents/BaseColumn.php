<?php

namespace BoredProgrammers\LaraGrid\Components\BaseComponents;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BaseColumn extends BaseLaraGridComponent
{

    protected string $label;

    protected Closure $renderer;

    protected Closure $attributes;

    protected string $columnTag = 'span';

    public function __construct(?string $modelField = null, ?string $label = null)
    {
        $this->setModelField($modelField);
        $this->setLabel($label ?: $modelField);
        $this->setRenderer($this->defaultRender());
        $this->setAttributes(function (Model $model) {
            return [];
        });
    }

    public function callRenderer(Model $model)
    {
        return ($this->renderer)($model);
    }

    public function setRenderer(Closure $renderer): static
    {
        $this->renderer = $renderer;

        return $this;
    }

    public function callAttributes(Model $model)
    {
        return ($this->attributes)($model);
    }

    public function getAttributes(Model $model): string
    {
        return collect($this->callAttributes($model))
            ->map(function ($value, $key) {
                return Str::of($key)->append('="', $value, '"');
            })
            ->join(' ');
    }

    public function setAttributes(Closure $attributes): static
    {
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
