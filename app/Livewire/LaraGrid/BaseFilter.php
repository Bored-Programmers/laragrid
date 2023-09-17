<?php

namespace App\Livewire\LaraGrid;

use App\Livewire\LaraGrid\Enums\FilterType;
use App\Livewire\LaraGrid\Enums\FiltrationType;

abstract class BaseFilter
{

    protected string $modelField;

    protected string $label;

    protected FilterType $filterType;

    protected FiltrationType $filtrationType;

    /*********************************************** GETTERS && SETTERS ***********************************************/

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

    public function getFilterType(): FilterType
    {
        return $this->filterType;
    }

    public function setFilterType(FilterType $filterType): void
    {
        $this->filterType = $filterType;
    }

    public function getFiltrationType(): FiltrationType
    {
        return $this->filtrationType;
    }

    public function setFiltrationType(FiltrationType $filtrationType): static
    {
        $this->filtrationType = $filtrationType;

        return $this;
    }

}
