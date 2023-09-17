<?php

namespace App\Livewire\LaraGrid\Filters;

use App\Livewire\LaraGrid\Enums\FilterType;
use App\Livewire\LaraGrid\Enums\FiltrationType;

abstract class BaseFilter
{

    protected FilterType $filterType;

    protected FiltrationType $filtrationType;

    /*********************************************** GETTERS && SETTERS ***********************************************/

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
