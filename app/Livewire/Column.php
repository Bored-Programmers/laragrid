<?php

namespace App\Livewire;

use App\Livewire\Enums\FilterType;
use App\Livewire\Filters\BaseFilter;
use App\Livewire\Filters\SelectFilter;
use App\Livewire\Filters\SelectFilterOption;
use Illuminate\Database\Eloquent\Model;

class Column
{

    protected string $modelField;

    protected string $label;

    protected bool $sortable = false;

    /** @var SelectFilterOption[] */
    protected array $options;

    protected string $prompt;

    protected ?BaseFilter $filter = null;

    public static function make(string $modelField, string $label): self
    {
        $column = new static($modelField, $label);

        return $column;
    }

    public function __construct(string $modelField, string $label)
    {
        $this->setModelField($modelField);
        $this->setLabel($label ?: $modelField);
    }

    public function getRecordValue(Model $record)
    {
        $value = $record->{$this->getModelField()};
        $filter = $this->getFilter();

        if (!$filter || $filter->getFilterType() !== FilterType::SELECT) {
            return $value;
        }

        /** @var SelectFilter $filter */
        $selectOption = collect($filter->getOptions())
            ->firstWhere(function (SelectFilterOption $option) use ($value) {
                return $option->getValue() == $value;
            });

        return $selectOption?->getLabel();
    }

    public function getModelField(): string
    {
        return $this->modelField;
    }

    public function setModelField(string $modelField): void
    {
        $this->modelField = $modelField;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    public function setSortable($isSortable = true): self
    {
        $this->sortable = $isSortable;

        return $this;
    }

    public function isSortable(): bool
    {
        return $this->sortable;
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

}
