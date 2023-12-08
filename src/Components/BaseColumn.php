<?php

namespace BoredProgrammers\LaraGrid\Components;

use BoredProgrammers\LaraGrid\Filters\BaseFilter;
use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class BaseColumn extends BaseLaraGridComponent
{

    protected ?string $modelField;

    protected string $label;

    protected bool $sortable = true;

    protected ?BaseFilter $filter = null;

    protected Closure $renderer;

    protected Closure $attributes;

    protected string $dateFormat = 'd.m.Y';

    protected string $columnTag = 'span';

    public function __construct(?string $modelField = null, string $label)
    {
        $this->setModelField($modelField);
        $this->setLabel($label ?: $modelField);

        $this->setRenderer(function (Model $model) {
            return $this->defaultRender($model);
        });

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

    public function getModelField(): ?string
    {
        return $this->modelField;
    }

    public function setModelField(?string $modelField): void
    {
        $this->modelField = $modelField;
    }

    public function getFilter(): ?BaseFilter
    {
        return $this->filter;
    }

    public function setFilter(BaseFilter $filter): static
    {
        $this->filter = $filter;

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

    public function isSortable(): bool
    {
        return $this->sortable;
    }

    public function setSortable($isSortable = true): static
    {
        $this->sortable = $isSortable;

        return $this;
    }

    public function getDateFormat(): string
    {
        return $this->dateFormat;
    }

    public function setDateFormat(string $dateFormat): static
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

}
