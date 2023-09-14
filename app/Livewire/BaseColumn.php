<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class BaseColumn
{

    protected string $modelField;

    protected string $label;

    protected bool $sortable = false;

    /** @var SelectOption[] */
    protected array $options;

    protected string $prompt;

    protected FilterType $filterType;

    protected FiltrationType $filtrationType;

    public function __construct(string $modelField, string $label)
    {
        $this->setModelField($modelField);
        $this->setLabel($label ?: $modelField);
    }

    public function getRecordValue(Model $record)
    {
        $value = $record->{$this->getModelField()};

        if (!is_bool($value)) {
            return $value;
        }

        $selectOption = collect($this->getOptions())
            ->firstWhere(function (SelectOption $option) use ($value) {
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

    public function setOptions(array|Collection $options): static
    {
        $selectOptions = [];

        foreach ($options as $value => $label) {
            $selectOptions[] = SelectOption::make($value, $label);
        }

        $this->options = $selectOptions;

        return $this;
    }

    public function getOptions(): array
    {
        return $this->options;
    }

    public function setFiltrationType(FiltrationType $filtrationType): static
    {
        $this->filtrationType = $filtrationType;

        return $this;
    }

    public function getFiltrationType(): FiltrationType
    {
        return $this->filtrationType;
    }

    public function setPrompt(string $prompt): static
    {
        $this->prompt = $prompt;

        return $this;
    }

    public function getPrompt(): string
    {
        return $this->prompt;
    }

    public function getFilterType(): FilterType
    {
        return $this->filterType;
    }

    public function setFilterType(FilterType $filterType): void
    {
        $this->filterType = $filterType;
    }

}
