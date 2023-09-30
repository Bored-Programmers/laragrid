<?php

namespace BoredProgrammers\LaraGrid;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use BoredProgrammers\LaraGrid\Enums\FilterType;
use BoredProgrammers\LaraGrid\Filters\BaseFilter;
use BoredProgrammers\LaraGrid\Filters\SelectFilterOption;
use UnitEnum;

class Column
{

    protected string $modelField;

    protected string $label;

    protected bool $sortable = false;

    protected ?BaseFilter $filter = null;

    protected Closure $renderer;

    protected string $dateFormat = 'd.m.Y';

    public function __construct(string $modelField, string $label)
    {
        $this->setModelField($modelField);
        $this->setLabel($label ?: $modelField);
        $this->setSortable();

        $this->setRenderer(function ($value) {
            return $this->defaultRender($value);
        });
    }

    public static function make(string $modelField, string $label): self
    {
        return new static($modelField, $label);
    }

    public function defaultRender(Model $record)
    {
        $value = data_get($record, $this->getModelField());

        if ($value instanceof UnitEnum) {
            $value = $value->name;
        }

        if ($value instanceof Carbon) {
            return $value->format($this->getDateFormat());
        }

        $filter = $this->getFilter();

        if ($filter && $filter->getFilterType() === FilterType::SELECT) {
            return $this->getValueLabelFromSelect($filter, $value);
        }

        return $value;
    }

    public function callRenderer($value)
    {
        return ($this->renderer)($value);
    }

    public function setRenderer(Closure $renderer): Column
    {
        $this->renderer = $renderer;

        return $this;
    }

    public function getModelField(): string
    {
        return $this->modelField;
    }

    public function setModelField(string $modelField): void
    {
        $this->modelField = $modelField;
    }

    public function getFilter(): ?BaseFilter
    {
        return $this->filter;
    }

    public function setFilter(BaseFilter $filter): Column
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

    public function setSortable($isSortable = true): self
    {
        $this->sortable = $isSortable;

        return $this;
    }

    public function getDateFormat(): string
    {
        return $this->dateFormat;
    }

    public function setDateFormat(string $dateFormat): Column
    {
        $this->dateFormat = $dateFormat;

        return $this;
    }

    /************************************************ PRIVATE ************************************************/

    /**
     * This section here is because when we have for example bool value (0/1),
     * we want to show label instead of value
     */
    private function getValueLabelFromSelect($filter, mixed $value): ?string
    {
        $selectOption = collect($filter->getOptions())
            ->firstWhere(function (SelectFilterOption $option) use ($value) {
                return $option->getValue() == $value;
            });

        return __($selectOption?->getLabel());
    }

}
